<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Images;

class ProductsController extends Controller
{
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
}
