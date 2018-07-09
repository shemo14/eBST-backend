<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // Dashboard Page
    public function dashboard() {
        return view('dashboard.dashboard');
    }

    public function loginForm() {
        return view('dashboard.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|string'
        ]);

        $rememberme = $request->rememberme == 1 ? true : false;
        if (auth()->guard()->attempt(['email' => $request->email, 'password' => $request->password], $rememberme)) {
            $user = User::findOrFail(auth()->user()->id);
            $user->active = 1;
            $user->save();
            return redirect()->route('dashboard');
        } else {
            if (User::where('email', $request->email)->count() == 0) {
                session()->flash('error_email', 'تحقق من صحة البريد الالكتروني');
            } else {
                session()->flash('error_password', 'تحقق من صحة كلمة المرور');
            }
            return redirect()->route('loginForm');
        }
    }

    public function logout() {
        auth()->guard()->logout();
        return redirect()->route('loginForm');
    }
}
