<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID lokasi dari session
        $locationId = session('petugas_location_id');

        if (!$locationId) {
            // Jika belum pilih lokasi, ambil semua titik parkir yang terdaftar
            $locations = ParkingLocation::all();
            return view('petugas.select-location', compact('locations'));
        }

        $location = ParkingLocation::find($locationId);
        return view('petugas.dashboard', compact('location'));
    }

    public function setLocation(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:parking_locations,id'
        ]);

        // Simpan lokasi terpilih ke session agar tetap aktif selama login
        session(['petugas_location_id' => $request->location_id]);

        return redirect()->route('petugas.dashboard');
    }

    public function updateSlot(Request $request)
    {
        $location = ParkingLocation::findOrFail($request->location_id);

        if ($request->action === 'increment') {
            if ($location->available_slots < $location->total_slots) {
                $location->increment('available_slots');
            }
        } elseif ($request->action === 'decrement') {
            if ($location->available_slots > 0) {
                $location->decrement('available_slots');
            }
        }

        return back()->with('status', 'Slot berhasil diperbarui!');
    }
}
