<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function index()
    {
        if (Auth::check()) {
            return redirect('/admin');
        }
        return view('dashboard.auth.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/admin');
        }

        return back()->withErrors([
            'error' => 'Şifre veya Email hatalı',
        ]);

    }
}
