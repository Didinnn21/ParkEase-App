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
        // Ambil data asas
        $totalLocations = ParkingLocation::count();
        $totalCapacity = ParkingLocation::sum('total_slots');
        $totalAvailable = ParkingLocation::sum('available_slots');

        // Hitung Occupancy Rate (Kadar Pengisian) untuk Global Progress Bar
        // Rumus: (Total Kapasitas - Total Tersedia) / Total Kapasitas * 100
        $occupiedSlots = $totalCapacity - $totalAvailable;
        $occupancyRate = $totalCapacity > 0 ? ($occupiedSlots / $totalCapacity) * 100 : 0;

        $data = [
            'total_locations' => $totalLocations,
            'total_capacity'  => $totalCapacity, // Data baru
            'total_available' => $totalAvailable,
            'occupancy_rate'  => round($occupancyRate, 1), // Data baru (1 desimal)
            'total_petugas'   => User::where('role', 'petugas')->count(),
            'total_user'      => User::where('role', 'user')->count(),
            'locations'       => ParkingLocation::latest()->get()
        ];

        return view('admin.dashboard', $data);
    }
}
