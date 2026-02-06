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
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi harus sesuai dengan name="" yang ada di input HTML form Anda
        $request->validate([
            'name'           => 'required|string|max:255',
            'address'        => 'required|string',
            'latitude'       => 'required',
            'longitude'      => 'required',
            'region'         => 'required|string',
            'total_slots'    => 'required|integer|min:1',
            'price_per_hour' => 'required|integer|min:0',
        ]);

        try {
            // 2. Gunakan mass assignment
            ParkingLocation::create([
                'name'            => $request->name,
                'address'         => $request->address,
                'latitude'        => $request->latitude,
                'longitude'       => $request->longitude,
                'region'          => $request->region,
                'total_slots'     => $request->total_slots,
                'available_slots' => $request->total_slots, // Awalnya sama dengan total
                'price_per_hour'  => $request->price_per_hour,
                'category'        => 'umum', // Kita set default karena di form tidak ada pilihan kategori
                'status'          => 'open',
            ]);

            return back()->with('success', 'Lokasi parkir berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Tampilkan pesan error jika database menolak (misal: kolom kurang)
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
    public function destroy(ParkingLocation $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')
            ->with('success', 'Lokasi berhasil dihapus.');
    }
}
