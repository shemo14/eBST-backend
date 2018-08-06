<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index() {
        $pages = Page::all();
        return view('dashboard.pages.index', compact('pages'));
    }

    public function create() {
        return view('dashboard.pages.create');
    }

    public function store(Request $request) {
        $rules = [
            'title'     => 'required',
            'content'   => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $page = new Page();
        $page->title = $request->title;
        $page->content = $request->input('content');
        $page->save();

        addReport(auth()->user()->id, 'باضافة صفحة جديدة', $request->ip());
        Session::flash('success', 'تم اضافة الصفحة بنجاح');
        return redirect()->route('pages');
    }

    public function edit($id) {
       $page = Page::find($id);
       return view('dashboard.pages.edit', compact('page'));
    }

    public function update(Request $request) {
        $rules = [
            'title'     => 'required',
            'content'   => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $page = Page::find($request->id);
        $page->title = $request->title;
        $page->content = $request->input('content');
        $page->save();

        addReport(auth()->user()->id, 'بتعديل صفحة', $request->ip());
        Session::flash('success', 'تم تعديل الصفحة بنجاح');
        return redirect()->route('pages');
    }

    public function show($id) {
        $page = Page::find($id);
        return view('dashboard.pages.show', compact('page'));
    }

    public function destroy() {
        Page::find(\request('delete_id'))->delete();
        addReport(auth()->user()->id, 'بتعديل صفحة', \request()->ip());
        Session::flash('success', 'تم تعديل الصفحة بنجاح');
        return back();
    }

    public function destroyAll(Request $request) {
        $requestIds = json_decode($request->data);
        foreach ($requestIds as $id) {
            $ids [] = $id->id;
        }
        if (Page::whereIn('id', $ids)->delete()) {
            addReport(auth()->user()->id, 'قام بحذف العديد من الصفحات', $request->ip());
            Session::flash('success', 'تم الحذف بنجاح');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
