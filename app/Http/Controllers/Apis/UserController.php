<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update_password(Request $request){
        $rules = [
            'old_password'  => 'required',
            'new_password'  => 'required',
            'lang'          => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $user = Auth::user();
        if (Hash::check($request['old_password'], $user->password)){
            $user->password = bcrypt($request['new_password']);
            $user->save();
            $msg = $request['lang'] == 'ar' ? 'تم تغير كلمة المرور بنجاح' : 'your password changed successfully';
            return returnResponse(null, $msg, 200);
        }else{
            $msg = $request['lang'] == 'ar' ? 'كلمة المرور القديمة غير صحيحة' : 'old password is not correct';
            return returnResponse(null, $msg, 400);
        }
    }

    public function update_profile(Request $request){
        $rules = [
            'name'          => 'required',
            'phone'         => 'required|unique:users,phone,' . Auth::user()->id,
            'email'         => 'required|unique:users,email,' . Auth::user()->id,
            'country_id'    => 'required',
            'lang'          => 'required',
            'type'          => 'required',
        ];
        App::setLocale($request['lang']);
        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $user               = Auth::user();
        $user->name         = $request['name'];
        $user->email        = $request['email'];
        $user->phone        = $request['phone'];
        $user->country_id   = $request['country_id'];
        $user->lang         = $request['lang'];
        $user->type         = $request['type'];
        $user->desc         = $request['desc'];

        if ($request['image']){
            $user->avatar = save_img_base64($request['image'], 'images/users');
        }

        if ($user->save()){
            $userData      = [
                'id'            => $user->id,
                'name'          => $user->name,
                'email'         => $user->email,
                'phone'         => $user->phone,
                'desc'          => $user->desc,
                'country_id'    => $user->country_id,
                'code'          => $user->code,
                'avatar'        => url('images/users') . '/' . $user->avatar,
                'active'        => $user->active,
                'checked'       => $user->checked,
                'role'          => $user->role,
                'lat'           => $user->lat,
                'lng'           => $user->lng,
                'type'          => $user->type,
                'device_id'     => $user->device_id,
                'lang'          => $user->lang,
                'isNotify'      => $user->isNotify,
                'created_at'    => $user->created_at,
                'updated_at'    => $user->updated_at,
                'token'         => $request->header('Authorization'),
            ];

            $msg = $request['lang'] == 'ar' ? 'تم تعديل بيانات الحساب بنجاح' : 'your account updated successfully';
            return returnResponse($userData, $msg, 200);
        }
    }
}
