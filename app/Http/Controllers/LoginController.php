<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    function login_proses(Request $request)
    {
        $request->validate(
            [

                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email wajib diisi',
                'password.required' => 'password wajib diisi',
            ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($infologin)) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('')->withErrors("Email atau password yang dimasukkan tidak sesuai")->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
