<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tangkap data lat/lng dari URL
        $lat = $request->query('lat');
        $lng = $request->query('lng');

        // 2. Cek apakah user sudah mengaktifkan GPS?
        if ($lat && $lng) {
            // Jika YA: Urutkan dari yang terdekat (pakai rumus Model tadi)
            try {
                $locations = ParkingLocation::nearby($lat, $lng)->get();
                $isSorted = true; // Status: Sudah diurutkan
            } catch (\Exception $e) {
                $locations = ParkingLocation::latest()->get();
                $isSorted = false;
            }
        } else {
            // Jika TIDAK: Tampilkan list biasa
            $locations = ParkingLocation::latest()->get();
            $isSorted = false; // Status: Belum diurutkan
        }

        // Kirim variabel $isSorted ke View agar tombol bisa muncul/hilang
        return view('user.dashboard', compact('locations', 'isSorted'));
    }
}
