<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingHistory;
use App\Models\ParkingLocation;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $locationId = $request->location_id;
        $userId = $request->user_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Query Dasar
        $query = ParkingHistory::with(['location', 'user'])->latest();

        // Terapkan Filter jika ada
        if ($locationId) {
            $query->where('parking_location_id', $locationId);
        }
        if ($userId) {
            $query->where('user_id', $userId);
        }
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        // Pagination (10 data per halaman)
        $histories = $query->paginate(10)->withQueryString();

        // Data untuk Dropdown Filter
        $locations = ParkingLocation::all();
        $users = User::where('role', 'petugas')->get();

        return view('admin.history.index', compact('histories', 'locations', 'users'));
    }
}
