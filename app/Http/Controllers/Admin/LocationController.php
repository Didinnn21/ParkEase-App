<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // Menampilkan daftar lokasi
        $locations = ParkingLocation::latest()->get();
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        // Menampilkan form tambah lokasi
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'category' => 'required|in:mall,pasar,bandung_tengah,umum',
            'total_slots' => 'required|integer|min:1',
        ]);

        // Simpan ke Database
        ParkingLocation::create([
            'name' => $request->name,
            'address' => $request->address,
            'category' => $request->category,
            'total_slots' => $request->total_slots,
            'available_slots' => $request->total_slots,
            'status' => 'open',

            // Nilai Default (Penting agar tidak error SQL)
            'latitude' => -6.9175, // Default koordinat Bandung
            'longitude' => 107.6191,
            'price_per_hour' => 3000, // Default harga
            'region' => 'Bandung',
        ]);

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi parkir berhasil ditambahkan!');
    }

    public function destroy(ParkingLocation $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
