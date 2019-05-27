<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Models\Favs;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class FavsController extends Controller
{
    public function set_fav(Request $request){
        $rules = [
            'product_id'    => 'required',
            'lang'          => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        if (!$request->header('Authorization') && !$request['device_id'])
            return returnResponse(null, 'plz, enter auth token or device id to set fav', 400);

        $like_msg     = $request['lang'] == 'ar' ? 'تم الاعجاب بنجاح' : 'liked successfully';
        $dislike_msg  = $request['lang'] == 'ar' ? 'تم الغاء الاعجاب بنجاح' : 'disliked successfully';

        if ($request->header('Authorization')){  // if user auth...
            $user         = JWTAuth::parseToken()->authenticate();

            if (Favs::where(['product_id' => $request['product_id'], 'user_id' => $user->id])->exists()){
                Favs::where(['product_id' => $request['product_id'], 'user_id' => $user->id])->delete();
                return returnResponse(null, $dislike_msg, 200);
            }else{
                $fav              = new Favs();
                $fav->product_id  = $request['product_id'];
                $fav->user_id     = Auth::user()->id;
                $fav->save();

                $user_id = Products::where('id', $request['product_id'])->first()->user_id;
                set_notification($user_id, null,$request['product_id'], $fav->id, null, 4, $request['lang'], null, null);

                return returnResponse(null, $like_msg, 200);
            }

        }else{  // if user guest
            if (Favs::where(['product_id' => $request['product_id'], 'device_id' => $request['device_id']])->exists()){
                Favs::where(['product_id' => $request['product_id'], 'device_id' => $request['device_id']])->delete();
                return returnResponse(null, $dislike_msg, 200);
            }else{
                $fav                = new Favs();
                $fav->product_id    = $request['product_id'];
                $fav->device_id     = $request['device_id'];
                $fav->save();

                $user_id = Products::where('id', $request['product_id'])->first()->user_id;
                set_notification($user_id, null,$request['product_id'], $fav->id, null, 4, $request['lang'], null, null);

                return returnResponse(null, $like_msg, 200);
            }
        }
    }

    public function get_fav(Request $request){
        if (!$request->header('Authorization') && !$request['device_id'])
            return returnResponse(null, 'plz, enter auth token or device id to set fav', 400);

        $productsIds  = [];
        $products     = [];

        if ($request->header('Authorization')){  // if user auth...
            $user           = JWTAuth::parseToken()->authenticate();
            $productsIds    = Favs::where('user_id', $user->id)->get(['product_id']);
            $products       = Products::whereIn('id', $productsIds)->get();

        }else{  // if user guest
            $productsIds    = Favs::where('device_id', $request['device_id'])->get(['product_id']);
            $products       = Products::whereIn('id', $productsIds)->get();
        }

        $all_products = [];
        foreach ($products as $product) {
            $all_products [] = [
                'id'    => $product->id,
                'name'  => $product->name,
                'price' => $product->price,
                'type'  => $product->type,
                'image' => url('images/products') . '/' . $product->images()->first()->name,
                'rate'  => $product->rate()->avg('rate'),
            ];
        }

        return returnResponse($all_products, '', 200);

    }
}
