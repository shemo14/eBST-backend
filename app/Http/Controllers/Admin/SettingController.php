<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use App\Models\AppSetting;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index() {
        $setting = AppSetting::all();
        $socials = Social::all();
        return view('dashboard.settings.index', [
            'setting'  => $setting,
            'socials'  => $socials,
        ]);
    }

    public function updateSiteInfo(Request $request) {

        $rules =[
            'site_name' => 'required'
        ];
        $messages = [
            'site_name.required' => 'اسم التطبيق مطلوب'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }

        if ($request->has('site_logo')) {

            $image = $request->file('site_logo');
            $name = 'logo.png';
            $path = public_path('/images/site');
            $image->move($path, $name);
        }

        $siteName           = AppSetting::where('key', 'site_name')->first();
        $siteName->value    = $request->site_name;
        $siteName->save();

        $address_ar        = AppSetting::where('key', 'address_ar')->first();
        $address_ar->value = $request->address_ar;
        $address_ar->save();

        $address_en        = AppSetting::where('key', 'address_en')->first();
        $address_en->value = $request->address_en;
        $address_en->save();

        $phone          = AppSetting::where('key', 'phone')->first();
        $phone->value   = $request->phone;
        $phone->save();

        $email          = AppSetting::where('key', 'email')->first();
        $email->value   = $request->email;
        $email->save();

        $ip = $request->ip();

        addReport(auth()->user()->id, 'بتحديث بيانات التطبيق', $ip);
        Session::flash('success', 'تم تعديل بيانات التطبيق');
        return back();
    }

    public function storeSocial(Request $request) {
        $rules = [
            'site_name' => 'required|min:2|max:190',
            'icon'      => 'required|image',
            'url'       => 'required|url',
        ];
        $messages = [
            'site_name.required'    => 'اسم الموقع مطلوب',
            'site_name.min'         => 'اسم الموقع لابد ان يكون اكتر من حرفين',
            'site_name.max'         => 'اسم الموقع لابد ان يكون اقل من 190 حرف',
            'icon.required'         => 'الشعار مطلوب',
            'icon.image'            => 'الشعار لابد ان يكون صورة',
            'url.required'          => 'الرابط مطلوب',
            'url.url'               => 'الرابط غير صحبح',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $social             = new Social();
        $social->site_name  = $request->site_name;
        $social->icon       = UploadFile::uploadImage($request->file('icon'), 'social');
        $social->url        = $request->url;
        $social->save();

        $ip = $request->ip();

        addReport(auth()->user()->id, 'باضافة موقع تواصل جدبد', $ip);
        Session::flash('success', 'تم اضافة الموقع');
        return back();
    }

    public function updateSocial(Request $request) {
        $rules = [
            'edit_name' => 'required|min:2|max:190',
            'edit_icon'      => 'required|min:2|max:190',
            'edit_url'       => 'required|url',
            'id'        => 'required',
        ];
        $messages = [
            'edit_name.required'    => 'اسم الموقع مطلوب',
            'edit_name.min'         => 'اسم الموقع لابد ان يكون اكتر من حرفين',
            'edit_name.max'         => 'اسم الموقع لابد ان يكون اقل من 190 حرف',
            'edit_icon.required'         => 'الشعار مطلوب',
            'edit_icon.min'              => 'الشعار لابد ان يكون اكبر من حرفين',
            'edit_icon.max'              => 'الشعار لابد ان يكون اقل من 190 حرف',
            'edit_url.required'          => 'الرابط مطلوب',
            'edit_url.url'               => 'الرابط غير صحبح',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $social = Social::findOrFail($request->id);
        $social->site_name = $request->edit_name;
        $social->icon = $request->edit_icon;
        $social->url = $request->edit_url;
        $social->save();

        $ip = $request->ip();

        addReport(auth()->user()->id, 'بتحديث موقع تواصل', $ip);
        Session::flash('success', 'تم تحديث الموقع');
        return back();
    }

    public function deleteSocial($id, Request $request) {
        Social::where('id', $id)->delete();

        $ip = $request->ip();
        addReport(auth()->user()->id, 'بحذف موقع تواصل', $ip);
        Session::flash('success', 'تم حذف الموقع');
        return back();
    }

    public function aboutApp(Request $request){
        $rules =[
            'about_ar' => 'required',
            'about_en' => 'required'
        ];
        $messages = [
            'about_ar.required' => 'عن التطبيق بالعربية مطلوب',
            'about_en.required' => 'عن التطبيق بالانجليزية مطلوب',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }

        $about_ar = AppSetting::where('key', 'about_ar')->first();
        $about_ar->value = $request->about_ar;
        $about_ar->save();

        $about_en = AppSetting::where('key', 'about_en')->first();
        $about_en->value = $request->about_en;
        $about_en->save();

        $ip = $request->ip();

        addReport(auth()->user()->id, 'بتحديث بيانات التطبيق', $ip);
        Session::flash('success', 'تم تعديل بيانات التطبيق');
        return back();
    }

    public function policy(Request $request){
        $rules =[
            'policy_ar' => 'required',
            'policy_en' => 'required'
        ];
        $messages = [
            'policy_ar.required' => 'الشروط و الاحكام بالعربية مطلوب',
            'policy_en.required' => 'الشروط و الاحكام بالانجليزية مطلوب',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return back()->withErrors($validator);
        }

        $policy_ar = AppSetting::where('key', 'policy_ar')->first();
        $policy_ar->value = $request->policy_ar;
        $policy_ar->save();

        $policy_en = AppSetting::where('key', 'policy_en')->first();
        $policy_en->value = $request->policy_en;
        $policy_en->save();

        $ip = $request->ip();

        addReport(auth()->user()->id, 'بتحديث بيانات التطبيق', $ip);
        Session::flash('success', 'تم تعديل بيانات التطبيق');
        return back();
    }
}
