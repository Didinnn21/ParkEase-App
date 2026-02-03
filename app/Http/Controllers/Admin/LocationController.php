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

    public function create()
    {
        // Pastikan Anda sudah membuat file view create.blade.php
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            // Pastikan input select di form menggunakan value ini
            'category' => 'required|in:mall,pasar,bandung_tengah,umum',
            'total_slots' => 'required|integer|min:1',
        ]);

        try {
            // 2. Simpan
            ParkingLocation::create([
                'name' => $request->name,
                'address' => $request->address,
                'category' => $request->category, // Simpan Kategori
                'total_slots' => $request->total_slots,
                'available_slots' => $request->total_slots,
                'status' => 'open',

                // Data Default (Wajib ada agar database tidak menolak)
                'latitude' => -6.9175,
                'longitude' => 107.6191,
                'price_per_hour' => 3000,
                'region' => 'Bandung',
            ]);

            return redirect()->route('admin.locations.index')
                ->with('success', 'Lokasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Jika error, kembalikan ke form dengan pesan
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function destroy(ParkingLocation $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi dihapus.');
    }
}
