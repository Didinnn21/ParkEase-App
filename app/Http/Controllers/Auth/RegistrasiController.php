<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // 1. Validasi Input sesuai aturan SKPL
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Enkripsi Password (Bcrypt) & Simpan ke MySQL
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role untuk pendaftar umum
        ]);

        // 3. Redirect ke Login dengan Pesan Sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk.');
    }
}
