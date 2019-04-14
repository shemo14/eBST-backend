<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Countries;

class ApisController extends Controller
{
    public function countries(Request $request){
        $rules = [
            'lang'  => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $countries      = Countries::select('id', 'name_' . $request['lang'] . ' as name')->get();
        $allCountries   = [];

        foreach ($countries as $country) {
            $allCountries[] = [
                'id'    => $country->id,
                'name'  => $country->name
            ];
        }

        return returnResponse($allCountries, '', 200);
    }

    public function app_info(Request $request){
       $type     = $request['type'];
       $settings = AppSetting::where('key', $type)->first();

    }
}
