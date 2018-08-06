<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoneyAccountController extends Controller
{
    public function index(){
        return view('dashboard.money-accounts.index');
    }
}
