<?php
namespace App\Http\Controllers\Apis;

use App\Models\ContactUs;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function about_us(Request $request){
        $rules = [
            'lang'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $about_us = 'about_' . $request['lang'];
        return returnResponse(['about_us' => settings($about_us)], '', 200);
    }

    public function policy(Request $request){
        $rules = [
            'lang'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $policy = 'policy_' . $request['lang'];
        return returnResponse(['policy' => settings($policy)], '', 200);
    }

    public function app_info(Request $request){
        $rules = [
            'lang'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $socials    = Social::get();
        $allSocials = [];

        foreach ($socials as $social) {
            $allSocials[] = [
                'name' => $social->site_name,
                'logo' => url('images/social') . '/' . $social->icon,
                'url'  => $social->url,
            ];
        }

        $data = [
            'phone'     => settings('phone'),
            'email'     => settings('email'),
            'address'   => settings('address_' . $request['lang']),
            'socials'   => $allSocials
        ];

        return returnResponse($data, '', 200);
    }

    public function contact_us(Request $request){
        $rules = [
            'lang'    => 'required',
            'name'    => 'required',
            'email'   => 'required',
            'msg'     => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $contact        = new ContactUs();
        $contact->name  = $request['name'];
        $contact->email = $request['email'];
        $contact->msg   = $request['msg'];

        if ($contact->save()){
            $msg = $request['lang'] == 'ar' ? 'تم ارسال الراسلة بنجاح' : 'your message sent successfully';
            return returnResponse(null, $msg, 200);
        }
    }
}
