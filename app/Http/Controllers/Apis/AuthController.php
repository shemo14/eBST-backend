<?php

namespace App\Http\Controllers\Apis;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request){
        $rules = [
            'phone'         => 'required|exists:users,phone',
            'password'      => 'required|string',
            'device_id'     => 'required',
            'lang'          => 'required'
        ];

        $validator = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }
        $credentials = $request->only('phone', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                $msg = $request['lang'] == 'ar' ? 'كلمة المرور غير صحيحة' : 'password not correct';
                return returnResponse(null, $msg, 400);
            }
        } catch (JWTException $e) {
            return returnResponse(null,'could_not_create_token', 500);
        }


        $user = auth()->user();
        $user['token'] = $token;
        $msg = $request['lang'] == 'ar' ? 'تم تسجيل الدخول بنجاح' : 'user login successfully';
        return returnResponse($user, $msg, 200);
    }

    public function register(Request $request){
        $rules = [
            'name'          => 'required',
            'password'      => 'required|min:6',
            'device_id'     => 'required',
            'lang'          => 'required',
            'type'          => 'required',
            'email'         => 'required|unique:users,email',
            'phone'         => 'required|unique:users,phone',
        ];

        $validator = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }


        $user             = new User();
        $user->name       = $request['name'];
        $user->phone      = $request['phone'];
        $user->device_id  = $request['device_id'];
        $user->lang       = $request['lang'];
        $user->email      = $request['email'];
        $user->type       = $request['type'];
        $user->active     = 1;
        $user->password   = bcrypt($request['password']);

        $code             = rand(1111, 9999);
        $user->code       = $code;

        if ($user->save()){
            $data['code'] = $user->code;
            $msg = $request['lang'] == 'ar' ? 'تم التسجيل بنجاح' : 'successfully registered';
            return returnResponse($data, $msg, 200);
        }
    }


    public function forget_password(Request $request){
        $rules = [
            'phone' => 'required',
            'lang'  => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $user = User::where('phone', $request['phone'])->first();
        if ($user){
            $code        = rand(1111, 9999);
            $user->code  = $code;
            $user->update();

            $data['id']      = $user->id;
            $data['code']    = $user->code;
            $msg             = $request['lang'] == 'ar' ? 'تم ارسال كود التفعيل' : 'activation code sent successfully';
            return returnResponse($data, $msg, 200);
        }else{
            $msg = $request['lang'] == 'ar' ? 'رقم الهاتف غير موجود' : 'phone number not exists';
            return returnResponse(null, $msg, 400);
        }
    }

    public function renew_password(Request $request){
        $rules = [
            'id'        => 'required',
            'password'  => 'required|min:6',
            'lang'      => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $user           = User::find($request['id']);
        $user->password = bcrypt($request['password']);
        $user->save();

        $msg  = $request['lang'] == 'ar' ? 'تم تغير كلمة المرور بنجاح' : 'password updated successfully';
        return returnResponse(null, $msg, 200);
    }
}
