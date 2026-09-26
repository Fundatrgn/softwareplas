<?php

namespace App\Http\Controllers\danisan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::guard('patient')->check()) {
            return redirect('/danisan/panel');
        }
        return view('danisan.giris');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('patient')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/danisan/panel');
        }

        return back()->withErrors([
            'error' => 'Kullanıcı adı veya şifre hatalı.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('patient')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/danisan/giris');
    }
}
