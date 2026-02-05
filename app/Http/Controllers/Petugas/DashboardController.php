<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParkingHistory; // Pastikan Model ini sudah dibuat
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil Petugas yang sedang login
        $user = Auth::user();

        // 2. Ambil Lokasi yang ditugaskan kepadanya (Guna relasi 'location')
        $location = $user->location;

        // 3. Jika Admin lupa assign lokasi, beri pesan error
        if (!$location) {
            return view('petugas.dashboard', ['error' => 'Akun Anda belum ditugaskan ke lokasi manapun. Hubungi Admin.']);
        }

        // 4. Kirim data lokasi ke View
        return view('petugas.dashboard', compact('location'));
    }

    public function updateSlot(Request $request)
    {
        $request->validate([
            'action' => 'required|in:increment,decrement',
        ]);

        $user = Auth::user();
        $location = $user->location;

        if (!$location) {
            return back()->with('error', 'Error: Lokasi tidak ditemukan.');
        }

        // Simpan snapshot sebelum perubahan untuk history
        $previousSlots = $location->available_slots;

        // Logik Update (Sesuai SKPL 9.5)
        if ($request->action === 'increment') {
            // Menambah slot (Kendaraan KELUAR)
            if ($location->available_slots < $location->total_slots) {
                $location->increment('available_slots');
            } else {
                return back()->with('error', 'Slot sudah maksimal! Tidak mungkin lebih dari kapasitas total.');
            }
        } elseif ($request->action === 'decrement') {
            // Mengurangi slot (Kendaraan MASUK)
            if ($location->available_slots > 0) {
                $location->decrement('available_slots');
            } else {
                return back()->with('error', 'Parkir sudah penuh! Tidak bisa mengurangi slot.');
            }
        }

        // Update Status Otomatis (Open/Full)
        if ($location->available_slots == 0) {
            $location->update(['status' => 'full']);
        } else {
            $location->update(['status' => 'open']);
        }

        // REKAM JEJAK (Audit Trail - Sesuai SKPL 13.160)
        // Kita simpan siapa yang ubah, bila, dan dari angka berapa ke berapa
        ParkingHistory::create([
            'parking_location_id' => $location->id,
            'user_id' => $user->id,
            'previous_available' => $previousSlots,
            'new_available' => $location->available_slots, // Ambil nilai terbaru
            'action' => $request->action,
            'notes' => 'Update manual via Dashboard Petugas'
        ]);

        return back()->with('success', 'Slot berhasil diperbarui.');
    }
}
