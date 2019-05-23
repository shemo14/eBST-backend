<?php

namespace App\Http\Controllers\Apis;

use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    public function notifications(Request $request){
        $rules = [
            'lang'        => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $user          = Auth::user();
        $notifications = Notifications::where('id', 'user_id', $user->id)->select('title_' . $request['lang'] . ' title', 'body_' . $request['lang'] . ' body', 'user_id', 'offer_id', 'product_id', 'created_at')->get();
        $allNotify     = [];

        foreach ($notifications as $notification) {
            $allNotify[] = [
                'id'            => $notification->id,
                'title'         => $notification->title,
                'body'          => $notification->body,
                'offer_id'      => $notification->offer_id,
                'product_id'    => $notification->product_id,
            ];
        }
    }

    public function stop_notifications(Request $request){
        $user = Auth::user();
        $msg  = '';

        if ($user->isNotify){
            $user->isNotify = 0;
            $msg = 'notification stoped successfully';
        }else{
            $user->isNotify = 1;
            $msg = 'notification worked successfully';
        }

        if ($user->save()){
            return returnResponse(null, $msg, 200);
        }
    }
}
