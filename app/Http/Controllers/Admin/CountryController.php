<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index () {
        $countries = Country::get();
        return view('dashboard.countries.index', compact('countries'));
    }
}
