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

            // Ambil role user yang sedang login
            $role = Auth::user()->role;

            // Redirect menggunakan Route Name (Lebih aman daripada ketik manual URL)
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'petugas') {
                return redirect()->route('petugas.dashboard');
            } else {
                // User Biasa
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ])->onlyInput('email');
    }
}
