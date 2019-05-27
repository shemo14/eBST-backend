<?php

namespace App\Http\Controllers\Apis;

use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
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
        App::setLocale($request['lang']);
        $user          = Auth::user();
        $notifications = Notifications::where('user_id', $user->id)->select('title_' . $request['lang'] . ' as title', 'body_' . $request['lang'] . ' as body', 'user_id', 'offer_id', 'product_id', 'type', 'id', 'created_at')->orderBy('id', 'desc')->get();
        $allNotify     = [];

        foreach ($notifications as $notification) {
            $allNotify[] = [
                'id'            => $notification->id,
                'title'         => $notification->title,
                'body'          => $notification->body,
                'offer_id'      => $notification->offer_id,
                'product_id'    => $notification->product_id,
                'type'          => $notification->type,
                'time'          => $notification->created_at->diffForHumans(),
            ];
        }

        return returnResponse($allNotify, '', 200);
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

    public function delete_notification(Request $request){
        $rules = [
            'notification_id'    => 'required',
            'lang'               => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $notify = Notifications::find($request['notification_id']);
        if ($notify->delete()){
            $msg = $request['lang'] == 'ar' ? 'تم حذف الاشعار بنجاح' : 'notification deleted successfully';
            return returnResponse(null, $msg, 200);
        }
    }
}
