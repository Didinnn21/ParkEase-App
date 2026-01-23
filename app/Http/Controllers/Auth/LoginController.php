<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->intended('admin/dashboard');
            } elseif ($role === 'petugas') {
                return redirect()->intended('petugas/dashboard');
            } else {
                // User Biasa -> Masuk ke Dashboard User yang ada GPS-nya
                return redirect()->intended('user/dashboard');
            }
        }

        return back()->withErrors(['email' => 'Email atau Password salah.'])->onlyInput('email');
    }
}
