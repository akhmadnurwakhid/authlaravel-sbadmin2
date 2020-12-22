<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember') ? true : false;
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember)) {
            Alert::warning('Peringatan', 'Email atau kata sandi yang anda masukan salah');
            return redirect()->back();
        }

        return redirect()->route('home');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create($validateData);
        Alert::success('Registrasi Berhasil', 'Silahkan login dengan email dan password yang telah anda masukan');
        return redirect()->route('login');

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
