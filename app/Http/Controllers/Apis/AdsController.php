<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Images;

class AdsController extends Controller
{

    public function ads(Request $request){
        $ads        = Ads::get();
        $adsImage   = [];
        foreach ($ads as $ad) {
            $adsImage[] = [
                'id'    => $ad->id,
                'image' => url('images/ads') . '/' . $ad->images()->first()->name
            ];
        }

        return returnResponse($adsImage, '', 200);

    }


    public function add_ads(Request $request){
        $user   = Auth()->user();
        $images = json_decode($request['images'], true);

        $ads          = new Ads();
        $ads->user_id = $user->id;

        if ($ads->save() && count($images) > 0){

            foreach ($images as $image) {
                $img        = new Images();
                $img->name  = save_img_base64($image, 'images/ads');
                $img->key   = $ads->id;
                $img->type  = 'ads';
                $img->save();
            }

            $msg  = $request['lang'] == 'ar' ? 'تم اضافة الاعلان بنجاح' : 'Advertising added successfully';
            return returnResponse(null, $msg, 200);
        }else{
            $msg  = $request['lang'] == 'ar' ? 'لم يتم الاضافة بعد ,الرجاء المحاولة مره اخري' : 'something went wrong, Plz try again';
            return returnResponse(null, $msg, 400);
        }
    }


    public function ad_images(Request $request){
        $rules = [
            'id'    => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $ad        = Ads::find($request['id']);
        $images    = $ad->images()->get();
        $allImages = [];

        foreach ($images as $image) {
            $allImages[] = url('images/ads') . '/' . $image->name;
        }


        return returnResponse($allImages, '', 200);
    }
}
