<?php

namespace App\Http\Controllers\Apis;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Offers;
use Illuminate\Support\Facades\Auth;
use App\Models\Exchanges;
use App\Models\Auctions;
use App\Models\Images;

class OffersController extends Controller
{
    public function set_offer(Request $request){
        $rules = [
            'product_id'  => 'required',
            'type'        => 'required',
            'lang'        => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $offer               = new Offers();
        $offer->user_id      = Auth::user()->id;
        $offer->product_id   = $request['product_id'];
        $offer->price        = $request['price'];
        $offer->type         = $request['type'];

        if ($offer->save()){
            if ($request['type'] == 3 || $request['type'] == 4){
                $exchange               = new Exchanges();
                $exchange->name         = $request['name'];
                $exchange->desc         = $request['desc'];
                $exchange->offer_id     = $offer->id;

                if ($exchange->save()){
                    $images = json_decode($request['images'], true);
                    foreach ($images as $image) {
                        $img        = new Images();
                        $img->name  = save_img_base64($image, 'images/exchanges');
                        $img->key   = $exchange->id;
                        $img->type  = 'exchange';
                        $img->save();
                    }
                }
            }

            $msg  = $request['lang'] == 'ar' ? 'تم ارسال العرض بنجاح' : 'your offer sent successfully';
            return returnResponse(null, $msg, 200);
        }
    }

    public function offers(Request $request){
        $rules = [
            'type'        => 'required',
            'lang'        => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $user_id    = Auth::user()->id;
        $offers     = [];
        $allOffers  = [];

        if ($request['type'] == 0){
            $offers      = Offers::where('user_id', $user_id)->get();
        }else{
            $productsIds = Products::where('user_id', $user_id)->get(['id']);
            $offers      = Offers::whereIn('product_id', $productsIds)->get();
        }

        foreach ($offers as $offer) {
            $allOffers[] = [
                'id'            => $offer->id,
                'product_id'    => $offer->product_id,
                'product_name'  => $offer->product->name,
                'product_image' => url('images/products') . '/' . $offer->product->images()->first()->name,
                'offers_count'  => offers_counter($offer->product_id),
                'offer_type'    => offer_type($request['lang'], $offer->type)
            ];
        }

        return returnResponse($allOffers, '', 200);
    }

    public function product_offers(Request $request){
        $rules = [
            'product_id'  => 'required',
            'lang'        => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $product        = Products::find($request['product_id']);
        $offers         = Offers::where(['product_id' => $request['product_id'], 'status' => 0])->get();
        $allOffers      = [];
        $images         = $product->images()->get();
        $productImages  = [];

        foreach ($images as $image) {
            $productImages[] = url('images/products') . '/' . $image->name;
        }

        foreach ($offers as $offer) {
            $allOffers[] = [
                'offer_id' => $offer->id,
                'type'     => offer_type($request['lang'], $offer->type),
                'avatar'   => url('images/users') . '/' . $offer->user->avatar,
                'name'     => $offer->user->name,
            ];
        }

        $productDetails = [
            'id'        => $product->id,
            'name'      => $product->name,
            'type'      => offer_type($request['lang'], $product->type),
            'type_id'   => $product->type,
            'desc'      => $product->desc,
            'price'     => $product->price,
            'images'    => $productImages,
            'offers'    => $allOffers
        ];

        return returnResponse($productDetails, '', 200);
    }

    public function offer_action(Request $request){
        $rules = [
            'offer_id'    => 'required',
            'product_id'  => 'required',
            'lang'        => 'required',
            'status'      => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $offer         = Offers::find($request['offer_id']);
        $offer->status = $request['status'];

        if ($offer->save()){

            $offers    = Offers::where(['product_id' => $request['product_id'], 'status' => 0])->get();
            $allOffers = [];
            $msg       = '';

            foreach ($offers as $offer) {
                $allOffers[] = [
                    'offer_id' => $offer->id,
                    'type'     => offer_type($request['lang'], $offer->type),
                    'avatar'   => url('images/users') . '/' . $offer->user->avatar,
                    'name'     => $offer->user->name,
                ];
            }

            if ($request['status'] == 1)
                $msg = $request['lang'] == 'ar' ? 'تم قبول العرض بنجاح' : 'offer accepted successfully';
            else
                $msg = $request['lang'] == 'ar' ? 'تم رفض العرض بنجاح' : 'offer refused successfully';

            return returnResponse($allOffers, $msg, 200);
        }
    }

    public function offer_details(Request $request){
        $rules = [
            'offer_id'    => 'required',
            'lang'        => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $offer          = Offers::find($request['offer_id']);
        $offerDetails   = [];

        if ($offer->type == 1 || $offer->type == 2){
            $offerDetails = [
                'id'       => $offer->id,
                'avatar'   => url('images/users') . '/' . $offer->user->avatar,
                'name'     => $offer->user->name,
                'phone'    => $offer->user->phone,
                'price'    => $offer->price,
                'type'     => offer_type($request['lang'], $offer->type),
            ];
        }elseif ($offer->type == 3 || $offer->type == 4){
            $exchange        = Exchanges::where('offer_id', $offer->id)->first();
            $exchangeImages  = $exchange->images()->get();
            $allImages       = [];

            foreach ($exchangeImages as $exchangeImage) {
                $allImages[] = url('images/exchanges') . '/' . $exchangeImage->name;
            }

            $offerDetails = [
                'id'       => $offer->id,
                'avatar'   => url('images/users') . '/' . $offer->user->avatar,
                'name'     => $offer->user->name,
                'phone'    => $offer->user->phone,
                'price'    => $offer->price,
                'type'     => offer_type($request['lang'], $offer->type),
                'images'   => $allImages
            ];
        }

        return returnResponse($offerDetails, '', 200);
    }

    public function delete_offer(Request $request){
        $rules = [
            'offer_id'    => 'required',
            'lang'        => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $offer = Offers::find($request['offer_id']);

        if ($offer->delete()){
            $msg = $request['lang'] == 'ar' ? 'تم حذف العرض بنجاح' : 'offer deleted successfully';
            return returnResponse(null, $msg, 200);
        }
    }
}
