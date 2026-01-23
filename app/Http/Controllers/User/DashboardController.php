<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil input koordinat dari URL (dikirim oleh JavaScript nanti)
        $userLat = $request->query('lat');
        $userLng = $request->query('lng');

        if ($userLat && $userLng) {
            // SKPL 9.6: Jika ada koordinat, gunakan rumus Haversine (scopeNearby)
            // Urutkan dari yang terdekat
            $locations = ParkingLocation::nearby($userLat, $userLng)->get();
            $isSorted = true;
        } else {
            // Jika user tolak akses GPS, tampilkan semua lokasi (urutkan terbaru)
            $locations = ParkingLocation::latest()->get();
            $isSorted = false;
        }

        return view('user.dashboard', compact('locations', 'isSorted'));
    }
}
