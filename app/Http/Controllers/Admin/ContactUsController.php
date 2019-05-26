<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function index(Request $request){
        $msgs = ContactUs::get();
        return view('dashboard.contact-us.index', compact('msgs'));
    }

    public function deleteMsg(Request $request){
        ContactUs::findOrFail($request->delete_id)->delete();
        addReport(auth()->user()->id, 'بحذف الرسالة من اتصل بنا', $request->ip());
        Session::flash('success', 'تم حذف القسم بنجاح');
        return back();
    }

    public function deleteAllMsg(Request $request){
        $requestIds = json_decode($request->data);
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (ContactUs::whereIn('id', $ids)->delete()) {
            addReport(auth()->user()->id, 'قام بحذف العديد من رسائل اتصل بنا', $request->ip());
            Session::flash('success', 'تم الحذف بنجاح');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
