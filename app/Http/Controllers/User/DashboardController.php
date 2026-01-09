<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua lokasi parkir untuk ditampilkan ke pengguna
        $locations = ParkingLocation::all();
        return view('user.dashboard', compact('locations'));
    }
}
