<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = ParkingLocation::latest()->get();
        return view('admin.locations.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'region' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'total_slots' => 'required|integer|min:1',
            'price_per_hour' => 'required|integer',
        ]);

        ParkingLocation::create([
            'name' => $request->name,
            'address' => $request->address,
            'region' => $request->region,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'total_slots' => $request->total_slots,
            'available_slots' => $request->total_slots, // Awalnya penuh slot
            'price_per_hour' => $request->price_per_hour,
            'status' => 'open'
        ]);

        return back()->with('success', 'Lokasi parkir berjaya ditambah.');
    }

    public function destroy(ParkingLocation $location)
    {
        $location->delete();
        return back()->with('success', 'Lokasi parkir berjaya dihapus.');
    }
}
