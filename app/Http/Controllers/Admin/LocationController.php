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

    // 2. Menampilkan Form Tambah Lokasi
    public function create()
    {
        // Arahkan ke file view yang baru saja kita buat
        return view('admin.locations.create');
    }

    // 3. Menyimpan Lokasi Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            // Validasi kategori sesuai enum/pilihan kita
            'category' => 'required|in:mall,pasar,bandung_tengah,umum',
            'total_slots' => 'required|integer|min:1',
        ]);

        ParkingLocation::create([
            'name' => $request->name,
            'address' => $request->address,
            'category' => $request->category,       // Simpan Kategori
            'total_slots' => $request->total_slots,
            'available_slots' => $request->total_slots, // Saat baru dibuat, slot tersedia = total
            'status' => 'open',
            // Field latitude/longitude bisa ditambahkan nanti jika fitur peta sudah siap
        ]);

        return redirect()->route('admin.locations.index')->with('success', 'Lokasi parkir berhasil ditambahkan!');
    }

    // 4. Menghapus Lokasi
    public function destroy(ParkingLocation $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}
