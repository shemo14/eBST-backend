<?php

namespace App\Http\Controllers\Apis;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use JWTAuth;


class CategoriesController extends Controller
{
    public function categories(Request $request){
        $rules = [
            'lang'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $categories      = Categories::select('id', 'image', 'name_' . $request['lang'] . ' as name')->get();
        $all_categories  = [];
        foreach ($categories as $category) {
            $all_categories[] = [
                'id'    => $category->id,
                'name'  => $category->name,
                'image' => url('images/categories') . '/' . $category->image
            ];
        }

        return returnResponse($all_categories, '', 200);
    }

    public function categories_search(Request $request){
        $rules = [
            'lang'     => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $categories = [];

        if ($request['search']){
            $categories      = Categories::where('name_ar', 'LIKE' , '%'. $request['search'] .'%')
                                            ->orWhere('name_en', 'LIKE' , '%'. $request['search'] .'%')
                                            ->select('id', 'image', 'name_' . $request['lang'] . ' as name')->get();
        }else{
            $categories      = Categories::select('id', 'image', 'name_' . $request['lang'] . ' as name')->get();
        }

        $all_categories  = [];
        foreach ($categories as $category) {
            $all_categories[] = [
                'id'    => $category->id,
                'name'  => $category->name,
                'image' => url('images/categories') . '/' . $category->image
            ];
        }

        return returnResponse($all_categories, '', 200);
    }

    public function category_products(Request $request){
        $rules = [
            'category_id' => 'required',
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
            $user      = JWTAuth::parseToken()->authenticate();
            $user_id   = Auth::user()->id;
        }else
            $device_id  = $request['device_id'];

        $products    = Products::where('category_id', $request['category_id'])->get();
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
}
