<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data ringkasan statistik (Sesuai SKPL Fungsi Monitoring)
        $data = [
            'total_locations' => ParkingLocation::count(),
            'total_available' => ParkingLocation::sum('available_slots'),
            'total_petugas'   => User::where('role', 'petugas')->count(),
            'total_user'      => User::where('role', 'user')->count(),
            // Mengambil semua lokasi untuk tabel real-time
            'locations'       => ParkingLocation::latest()->get()
        ];

        return view('admin.dashboard', $data);
    }
}
