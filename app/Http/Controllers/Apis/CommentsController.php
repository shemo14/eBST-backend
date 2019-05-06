<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;
use App\Models\AppReports;

class CommentsController extends Controller
{
    public function comment(Request $request){
        $rules = [
            'product_id'  => 'required',
            'comment'     => 'required',
            'lang'        => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $add                = new Comments();
        $add->user_id       = Auth::user()->id;
        $add->product_id    = $request['product_id'];
        $add->comment       = $request['comment'];

        if ($add->save()){
            $comments       = Comments::where('product_id', $request['product_id'])->get();
            $allComments    = [];

            foreach ($comments as $comment) {
                $allComments[] = [
                    'id'           => $comment->id,
                    'comment'      => $comment->comment,
                    'user_name'    => $comment->user->name,
                    'user_avatar'  => url('images/users') . '/' . $comment->user->avatar
                ];
            }

            $msg = $request['lang'] == 'ar' ? 'تم التعليق بنجاح' : 'comment added successfully';
            return returnResponse($allComments, $msg, 200);
        }
    }

    public function comment_report(Request $request){
        $rules = [
            'comment_id'   => 'required',
            'lang'         => 'required',
            'report'       => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse(null, validateRequest($validator), 400);
        }

        $add                = new AppReports();
        $add->user_id       = Auth::user()->id;
        $add->comment_id    = $request['comment_id'];
        $add->report        = $request['report'];

        if ($add->save()){
            $msg = $request['lang'] == 'ar' ? 'تم ارسال الابلاغ بنجاح' : 'report sent successfully';
            return returnResponse(null, $msg, 200);
        }
    }
}
