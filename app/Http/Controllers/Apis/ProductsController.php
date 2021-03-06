<?php

namespace App\Http\Controllers\Apis;

use App\Models\Views;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Images;
use App\Models\Rates;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\Models\AppReports;
use Carbon\Carbon;

class ProductsController extends Controller
{
    public function show_product(Request $request){
        $rules = [
            'id'          => 'required',
            'lang'        => 'required',
            //   'device_id'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        if (!$request->header('Authorization') && !$request['device_id'])
            return returnResponse(null, 'plz, enter auth token or device id to set fav', 400);

        $product        = Products::find($request['id']);
        $images         = $product->images()->get();
        $productImages  = [];

        foreach ($images as $image) {
            $productImages[] = url('images/products') . '/' . $image->name;
        }

        $comments           = $product->comments()->get();
        $productComments    = [];

        foreach ($comments as $comment) {
            $productComments[] = [
                'id'           => $comment->id,
                'comment'      => $comment->comment,
                'user_name'    => $comment->user->name,
                'user_avatar'  => url('images/users') . '/' . $comment->user->avatar
            ];
        }

        $user_id   = null;
        $device_id = null;
        if ($request->header('Authorization')){
            $user       = JWTAuth::parseToken()->authenticate();
            $user_id    = Auth::user()->id;
        }else
            $device_id  = $request['device_id'];

        $productData = [
            'details'         => [
                'id'                => $product->id,
                'name'              => $product->name,
                'desc'              => $product->desc,
                'type'              => $product->type,
                'exchange_price'    => $product->exchange_price,
                'exchange_product'  => $product->exchange_product,
                'max_price'         => $product->max_price,
                'price'             => $product->price,
                'rate'              => $product->rate()->avg('rate'),
                'category_id'       => $product->category_id,
                'provider_name'     => $product->user->name,
                'provider_id'       => $product->user->id,
                'views'             => $product->views()->where('device_id', $request['device_id'])->count(),
                'isLiked'           => isLiked($product->id, $user_id, $device_id),
            ],
            'images'        => $productImages,
            'comments'      => $productComments
        ];

        return returnResponse($productData, '', 200);
    }

    public function view_product(Request $request){
        $rules = [
            'product_id'    => 'required',
            'device_id'     => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        if (!(Views::where(['device_id' => $request['device_id'], 'product_id' => $request['product_id']])->whereDate('created_at', Carbon::today())->exists())){
            $view             = new Views();
            $view->device_id  = $request['device_id'];
            $view->product_id = $request['product_id'];
            $view->save();
        }

        $views = Views::where(['device_id' => $request['device_id'], 'product_id' => $request['product_id']])->count();
        return returnResponse(['views' => $views], '', 200);
    }

    public function best_products(Request $request){
        if (!$request->header('Authorization') && !$request['device_id'])
            return returnResponse(null, 'plz, enter auth token or device id to set fav', 400);

        $user_id   = null;
        $device_id = null;
        if ($request->header('Authorization')){
            $user      = JWTAuth::parseToken()->authenticate();
            $user_id   = Auth::user()->id;
        }else
            $device_id  = $request['device_id'];

        $productIds = Views::select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->distinct()
            ->get(['product_id']);

        $products    = Products::whereIn('id', $productIds)->get();
        $allProducts = [];

        foreach ($products as $product) {
            $allProducts[] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'image'    => url('images/products') . '/' . $product->images()->first()->name,
                'rate'     => $product->rate()->avg('rate'),
                'price'    => $product->price,
                'isLiked'  => isLiked($product->id, $user_id, $device_id)
            ];
        }

        return returnResponse($allProducts, '', 200);
    }

    public function delete_product(Request $request){
        $rules = [
            'product_id'    => 'required',
            'lang'          => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $product = Products::find($request['product_id']);

        if ($product->delete()){
            $user = Auth::user();
            $products       = Products::where('user_id', $user->id)->get();
            $all_products   = [];

            foreach ($products as $product) {
                $all_products[] = [
                    'id'       => $product->id,
                    'name'     => $product->name,
                    'image'    => url('images/products') . '/' . $product->images()->first()->name,
                    'rate'     => $product->rate()->avg('rate'),
                    'price'    => $product->price,
                    'isLiked'  => isLiked($product->id, $user->id, null)
                ];
            }

            $msg  = $request['lang'] == 'ar' ? 'تم حذف المنتج بنجاح' : 'product deleted successfully';
            return returnResponse($all_products, $msg, 200);
        }
    }

    public function my_products(Request $request){
        $rules = [
            'lang'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $user           = Auth::user();
        $country        = $user->country()->select('name_' . $request['lang'] . ' as name')->first()->name;
        $products       = Products::where('user_id', $user->id)->get();
        $productsIds    = Products::where('user_id', $user->id)->get(['id']);
        $rate           = Rates::whereIn('product_id', $productsIds)->avg('rate');
        $views          = Views::whereIn('product_id', $productsIds)->count();
        $all_products   = [];

        foreach ($products as $product) {
            $all_products[] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'image'    => url('images/products') . '/' . $product->images()->first()->name,
                'rate'     => $product->rate()->avg('rate'),
                'price'    => $product->price,
                'isLiked'  => isLiked($product->id, $user->id, null)
            ];
        }

        $data = [
            'rate'     => $rate,
            'views'    => $views,
            'country'  => $country,
            'products' => $all_products
        ];

        return returnResponse($data, '', 200);
    }

    public function search_my_products(Request $request){
        $user_id     = Auth::user()->id;
        $products    = Products::where('user_id', $user_id)->where('name', 'LIKE', '%' . $request['search'] . '%')->get();
        $allProducts = [];

        foreach ($products as $product) {
            $allProducts[] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'image'    => url('images/products') . '/' . $product->images()->first()->name,
                'rate'     => $product->rate()->avg('rate'),
                'price'    => $product->price,
                'isLiked'  => isLiked($product->id, $user_id, null)
            ];
        }

        return returnResponse($allProducts, '', 200);
    }

    public function add_product(Request $request){
        $rules = [
            'images'        => 'required',
            'lang'          => 'required',
            'name'          => 'required',
            'type'          => 'required',
            'desc'          => 'required',
            'category_id'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $user   = Auth()->user();
        $images = json_decode($request['images'], true);
        $add    = new Products();

        $add->name              = $request['name'];
        $add->desc              = $request['desc'];
        $add->price             = $request['price'];
        $add->type              = $request['type'];
        $add->exchange_price    = $request['exchange_price'];
        $add->exchange_product  = $request['exchange_product'];
        $add->max_price         = $request['max_price'];
        $add->user_id           = $user->id;
        $add->category_id       = $request['category_id'];

        if ($add->save() && count($images) > 0){
            foreach ($images as $image) {
                $img        = new Images();
                $img->name  = save_img_base64($image, 'images/products');
                $img->key   = $add->id;
                $img->type  = 'product';
                $img->save();
            }

            $msg  = $request['lang'] == 'ar' ? 'تم اضافة المنتج بنجاح' : 'product added successfully';
            return returnResponse(null, $msg, 200);
        }else{
            $msg  = $request['lang'] == 'ar' ? 'لم يتم الاضافة بعد ,الرجاء المحاولة مره اخري' : 'something went wrong, Plz try again';
            return returnResponse(null, $msg, 400);
        }

    }

    public function edit_product(Request $request){
        $rules = [
            'images'        => 'required',
            'product_id'    => 'required',
            'lang'          => 'required',
            'name'          => 'required',
            'type'          => 'required',
            'desc'          => 'required',
            'category_id'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $user   = Auth()->user();
        $images = json_decode($request['images'], true);
        $edit   = Products::find($request['product_id']);

        $edit->name              = $request['name'];
        $edit->desc              = $request['desc'];
        $edit->price             = $request['price'];
        $edit->type              = $request['type'];
        $edit->exchange_price    = $request['exchange_price'];
        $edit->exchange_product  = $request['exchange_product'];
        $edit->max_price         = $request['max_price'];
        $edit->user_id           = $user->id;
        $edit->category_id       = $request['category_id'];

        if ($edit->save()){

            if (count($images) > 0){
                foreach ($images as $image) {
                    $img        = new Images();
                    $img->name  = save_img_base64($image, 'images/products');
                    $img->key   = $edit->id;
                    $img->type  = 'product';
                    $img->save();
                }
            }

            $msg  = $request['lang'] == 'ar' ? 'تم تعديل المنتج بنجاح' : 'product modified successfully';
            return returnResponse(null, $msg, 200);
        }else{
            $msg  = $request['lang'] == 'ar' ? 'لم يتم التعديل بعد ,الرجاء المحاولة مره اخري' : 'something went wrong, Plz try again';
            return returnResponse(null, $msg, 400);
        }
    }

    public function delete_image(Request $request){
        $rules = [
            'product_id'    => 'required',
            'lang'          => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        if (Images::where(['key' => $request['product_id'], 'type' => 'product'])->delete()){

            $images     = Images::where(['key' => $request['product_id'], 'type' => 'product'])->get();
            $allImages  = [];

            foreach ($images as $image) {
                $allImages[] = url('images/products') . '/' . $image->name;
            }

            $msg  = $request['lang'] == 'ar' ? 'تم حذف الصورة بنجاح' : 'image deleted successfully';
            return returnResponse($allImages, $msg, 200);
        }else{
            $msg  = $request['lang'] == 'ar' ? 'لم يتم الحذف بعد ,الرجاء المحاولة مرة اخري' : 'something went wrong, PLZ try again';
            return returnResponse(null, $msg, 200);
        }
    }

    public function rate(Request $request){
        $rules = [
            'product_id'    => 'required',
            'rate'          => 'required',
            'lang'          => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        if ($is_rated = Rates::where(['user_id' => Auth::user()->id, 'product_id' => $request['product_id']])->first()){
            $is_rated->rate = $request['rate'];
            $is_rated->update();

            $msg      = $request['lang'] == 'ar' ? 'تم التقيم بنجاح' : 'rated successfully';
            $avg_rate = Rates::where('product_id', $request['product_id'])->avg('rate');
            return returnResponse(['rate' => $avg_rate], $msg, 200);
        }else{
            $rate               = new Rates();
            $rate->user_id      = Auth::user()->id;
            $rate->rate         = $request['rate'];
            $rate->product_id   = $request['product_id'];
            if ($rate->save()){
                $avg_rate = $rate->avg('rate');
                $msg      = $request['lang'] == 'ar' ? 'تم التقيم بنجاح' : 'rated successfully';
                return returnResponse(['rate' => $avg_rate], $msg, 200);
            }else{
                $msg      = $request['lang'] == 'ar' ? 'لم يتم التقيم بعد ,الرجاء المحاولة مرة اخري' : 'something went wrong, plz try again';
                return returnResponse(null, $msg, 400);
            }
        }

    }

    public function products_search(Request $request){
        $rules = [
            'category_id' => 'required',
            'type'        => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        if (!$request->header('Authorization') && !$request['device_id'])
            return returnResponse(null, 'plz, enter auth token or device id to set fav', 400);

        $user_id   = null;
        $device_id = null;
        if ($request->header('Authorization')){
            $user       = JWTAuth::parseToken()->authenticate();
            $user_id    = Auth::user()->id;
        }else
            $device_id  = $request['device_id'];

        $type = [];
        if ($request['type'] == 1)
            $type = [1];
        elseif ($request['type'] == 2)
            $type = [2, 3, 4];
        elseif ($request['type'] == 3)
            $type = [3, 4];

        $products    = Products::whereIn('type', $type)->where('category_id', $request['category_id'])->where('name', 'LIKE', '%' . $request['search'] . '%')->get();
        $allProducts = [];

        foreach ($products as $product) {
            $allProducts[] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'image'    => url('images/products') . '/' . $product->images()->first()->name,
                'rate'     => $product->rate()->avg('rate'),
                'price'    => $product->price,
                'isLiked'  => isLiked($product->id, $user_id, $device_id)
            ];
        }

        return returnResponse($allProducts, '', 200);
    }

    public function products_filter(Request $request){
        $rules = [
            'category_id'   => 'required',
            'product_type'  => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        if (!$request->header('Authorization') && !$request['device_id'])
            return returnResponse(null, 'plz, enter auth token or device id to set fav', 400);

        $user_id   = null;
        $device_id = null;
        if ($request->header('Authorization')){
            $user       = JWTAuth::parseToken()->authenticate();
            $user_id    = Auth::user()->id;
        }else
            $device_id  = $request['device_id'];

        $products = Products::query();
        if ($request['country_id']){
            $usersIds = User::where('country_id', $request['country_id'])->get(['id']);
            $products = $products->whereIn('products.user_id', $usersIds);
        }

        if ($request['type']){
            $products = $products->where('type', $request['type']);
        }

        if ($request['rate']){
            $products = $products->join('rates', 'products.id', '=', 'rates.product_id')
                ->select('products.id', 'name', 'price')
                ->selectRaw('AVG(rates.rate) AS rate')
                ->groupBy('products.id')
                ->havingRaw('AVG(rates.rate) = ?', [$request['rate']]);
        }

        $type = [];
        if ($request['product_type'] == 1)
            $type = [1];
        elseif ($request['product_type'] == 2)
            $type = [2, 3, 4];
        elseif ($request['product_type'] == 3)
            $type = [3, 4];

        $products    = $products->whereIn('type', $type)->where('category_id', $request['category_id'])->get();
        $allProducts = [];

        foreach ($products as $product) {
            $allProducts[] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'image'    => url('images/products') . '/' . $product->images()->first()->name,
                'rate'     => $product->rate()->avg('rate'),
                'price'    => $product->price,
                'isLiked'  => isLiked($product->id, $user_id, $device_id)
            ];
        }

        return returnResponse($allProducts, '', 200);

    }

    public function product_report(Request $request){
        $rules = [
            'product_id'   => 'required',
            'lang'         => 'required',
            'report'       => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $add                = new AppReports();
        $add->user_id       = Auth::user()->id;
        $add->comment_id    = $request['product_id'];
        $add->report        = $request['report'];

        if ($add->save()){
            $msg = $request['lang'] == 'ar' ? 'تم ارسال الابلاغ بنجاح' : 'report sent successfully';
            return returnResponse(null, $msg, 200);
        }
    }

}
