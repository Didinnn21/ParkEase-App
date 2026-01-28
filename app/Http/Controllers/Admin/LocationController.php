<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // 1. Menampilkan Daftar Lokasi
    public function index()
    {
        $locations = ParkingLocation::latest()->get();
        return view('admin.locations.index', compact('locations'));
    }

    // 2. Menampilkan Form Tambah Lokasi (INI YANG HILANG SEBELUMNYA)
    public function create()
    {
        // Kita gunakan view index saja karena form sudah ada di sana (modal/inline)
        // Atau jika Anda ingin halaman terpisah, return view('admin.locations.create');
        // Untuk efisiensi tutorial ini, kita redirect ke index saja
        return redirect()->route('admin.locations.index');
    }

    // 3. Menyimpan Lokasi Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'total_slots' => 'required|integer|min:1',
            'price_per_hour' => 'required|integer', // Pastikan kolom ini ada di DB
            'region' => 'required|string'
        ]);

        ParkingLocation::create([
            'name' => $request->name,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'total_slots' => $request->total_slots,
            'available_slots' => $request->total_slots, // Awalnya penuh = kapasitas total
            'price_per_hour' => $request->price_per_hour,
            'region' => $request->region,
            'status' => 'open',
        ]);

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi parkir berhasil ditambahkan.');
    }

    // 4. Menghapus Lokasi
    public function destroy(ParkingLocation $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
