<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($request->email === env('DEMO_USER_EMAIL') && $request->password === env('DEMO_USER_PASS')) {
            Session::put('auth', true);
            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'Credenciales inválidas'])->withInput();
    }

    public function logout()
    {
        Session::forget('auth');
        return redirect('/login');
    }
}
