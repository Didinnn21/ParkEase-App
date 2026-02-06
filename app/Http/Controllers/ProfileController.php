<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user.
     */
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    /**
     * Menampilkan halaman form edit profil.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    /**
     * Memproses update data profil dan foto.
     */
    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        // Validasi input file
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = [
        'name' => $request->name,
    ];

    // Cek apakah ada file foto yang diupload
    if ($request->hasFile('photo')) {

        // 1. Hapus foto lama jika ada
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // 2. Simpan foto baru ke folder 'profile-photos'
        $path = $request->file('photo')->store('profile-photos', 'public');

        // 3. Simpan PATH-nya ke kolom database yang BENAR
        $data['profile_photo_path'] = $path;
    }

    $user->update($data);



    // --- PERBAIKAN LOGIKA REDIRECT ---
    // Opsi A: Tetap di halaman edit (Paling User Friendly)
    // return back()->with('success', 'Profil berhasil diperbarui!');

    // Opsi B: Redirect sesuai Role (Sesuai permintaan Anda)
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard')->with('success', 'Profil Admin berhasil diperbarui!');
    } elseif ($user->role === 'petugas') {
        return redirect()->route('petugas.dashboard')->with('success', 'Profil Petugas berhasil diperbarui!');
    } else {
        // Default untuk User biasa
        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
    /**
     * Menampilkan halaman ganti password.
     */
    public function changePassword()
    {
        return view('user.change-password');
    }

    /**
     * Memproses update password (untuk memperbaiki error rute undefined).
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }
}
