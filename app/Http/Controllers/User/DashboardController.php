<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use App\Models\ParkingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Dashboard: Menampilkan daftar lokasi parkir dengan Filter Kategori.
     */
    public function index(Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');
        $category = $request->query('category'); // Ambil parameter kategori
        $isSorted = false;

        // 1. Mulai Query Dasar (Hanya lokasi yang BUKA)
        $query = ParkingLocation::where('status', 'open');

        // 2. Logika Filter Kategori
        if ($category && $category !== 'semua') {
            if ($category === 'bandung_tengah') {
                // Filter khusus Bandung Tengah (Berdasarkan alamat atau kategori)
                $query->where(function ($q) {
                    $q->where('address', 'LIKE', '%Alun-Alun%')
                        ->orWhere('address', 'LIKE', '%Asia Afrika%')
                        ->orWhere('address', 'LIKE', '%Braga%')
                        ->orWhere('category', 'bandung_tengah');
                });
            } else {
                // Filter umum (Mall, Pasar, dll)
                $query->where('category', $category);
            }
        }

        // 3. Logika Sorting (Terdekat vs Terbaru)
        if ($lat && $lng && method_exists(ParkingLocation::class, 'scopeNearby')) {
            // Jika ada koordinat, urutkan berdasarkan jarak
            $query->nearby($lat, $lng);
            $isSorted = true;
        } else {
            // Default: urutkan terbaru
            $query->latest();
        }

        $locations = $query->get();
        $user = Auth::user();

        // Kirim variabel $category ke view untuk styling tombol aktif
        return view('user.dashboard', compact('locations', 'isSorted', 'user', 'category'));
    }

    /**
     * Menampilkan riwayat log parkir user.
     */
    public function history()
    {
        $histories = ParkingHistory::with('location')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.history', compact('histories'));
    }

    /**
     * Halaman Edit Profil
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    /**
     * Proses Update Profil & Foto
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            $file = $request->file('avatar');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('avatars', $fileName, 'public');
            $user->avatar = $fileName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Halaman Ganti Password
     */
    public function editPassword()
    {
        return view('user.change-password');
    }

    /**
     * Proses Ganti Password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama yang Anda masukkan salah.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.profile')->with('success', 'Password berhasil diubah. Silakan login ulang jika diperlukan.');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user')); // Pastikan nama file view sesuai
    }
}
