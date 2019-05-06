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

        $offer              = new Offers();
        $offer->user_id     = Auth::user()->id;
        $offer->product_id  = $request['product_id'];
        $offer->type        = $request['type'];

        if ($offer->save()){
            if ($request['type'] == 2){
                $exchange               = new Exchanges();
                $exchange->name         = $request['name'];
                $exchange->desc         = $request['desc'];
                $exchange->offer_id     = $offer->id;
                $exchange->extra_price  = $request['extra_price'];

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
            }elseif ($request['type'] == 3){
                $auction            = new Auctions();
                $auction->offer_id  = $offer->id;
                $auction->price     = $offer->price;
                $auction->save();
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
}
