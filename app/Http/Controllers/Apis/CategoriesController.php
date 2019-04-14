<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function categories(Request $request){
        $rules = [
            'lang'   => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $categories      = Categories::select('id', 'image', 'name_' . $request['lang'] . ' as name')->get();
        $all_categories  = [];
        foreach ($categories as $category) {
            $all_categories[] = [
                'id'    => $category->id,
                'name'  => $category->name,
                'image' => url('images/categories') . '/' . $category->image
            ];
        }

        return returnResponse($all_categories, '', 200);
    }

    public function categories_search(Request $request){
        $rules = [
            'search'   => 'required',
            'lang'     => 'required',
        ];

        $validator  = validator($request->all(), $rules);

        if ($validator->fails()) {
            return returnResponse([], validateRequest($validator), 400);
        }

        $categories      = Categories::where('name_ar', 'LIKE' , '%'. $request['search'] .'%')
                                        ->orWhere('name_en', 'LIKE' , '%'. $request['search'] .'%')
                                        ->select('id', 'image', 'name_' . $request['lang'] . ' as name')->get();

        $all_categories  = [];
        foreach ($categories as $category) {
            $all_categories[] = [
                'id'    => $category->id,
                'name'  => $category->name,
                'image' => url('images/categories') . '/' . $category->image
            ];
        }

        return returnResponse($all_categories, '', 200);
    }
}
