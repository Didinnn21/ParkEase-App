<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $location = ParkingLocation::first();
        return view('petugas.dashboard', compact('location'));
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
