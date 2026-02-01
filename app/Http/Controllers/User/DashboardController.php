<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use App\Models\ParkingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash; // Penting untuk fitur ganti password

class DashboardController extends Controller
{
    /**
     * Dashboard: Menampilkan daftar lokasi parkir.
     */
    public function index(Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');

        if ($lat && $lng) {
            try {
                // Scope nearby harus didefinisikan di model ParkingLocation
                $locations = ParkingLocation::nearby($lat, $lng)->get();
                $isSorted = true;
            } catch (\Exception $e) {
                $locations = ParkingLocation::latest()->get();
                $isSorted = false;
            }
        } else {
            $locations = ParkingLocation::latest()->get();
            $isSorted = false;
        }

        return view('user.dashboard', compact('locations', 'isSorted'));
    }

    /**
     * Menampilkan riwayat log parkir user.
     */
    public function history()
    {
        $histories = ParkingHistory::with('location')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history', compact('histories'));
    }

    /**
     * Fitur Edit Profil & Upload Foto
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            $fileName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $fileName);
            $user->avatar = $fileName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Redirect ke tampilan profil utama (GET)
        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Fitur Ganti Password
     */
    public function editPassword()
    {
        return view('user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Validasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah!']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.profile')->with('success', 'Password berhasil diubah!');
    }
}
