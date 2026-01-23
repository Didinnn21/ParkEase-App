<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ParkingLocation; // <--- Jangan lupa import ini!
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Ambil list user
        $users = User::with('location') // Eager load lokasi supaya efisien
                     ->whereIn('role', ['petugas', 'user'])
                     ->latest()
                     ->get();

        // Ambil list lokasi untuk dropdown di form tambah user
        $locations = ParkingLocation::all();

        return view('admin.users.index', compact('users', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:petugas,user',
            // Validasi: Jika role petugas, location_id wajib ada & wujud di DB
            'parking_location_id' => 'required_if:role,petugas|nullable|exists:parking_locations,id'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            // Simpan lokasi jika ada (null jika user biasa)
            'parking_location_id' => $request->role === 'petugas' ? $request->parking_location_id : null,
        ]);

        return back()->with('success', 'Pengguna berjaya ditambah.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Pengguna berjaya dihapus.');
    }
}
