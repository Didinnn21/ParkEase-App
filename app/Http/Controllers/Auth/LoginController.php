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
            $user = Auth::user();

            // Logika Pengalihan Berdasarkan Role (Penting!)
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'petugas':
                    return redirect()->route('petugas.dashboard');
                default:
                    return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Email atau Password salah.'])->onlyInput('email');
    }
}
