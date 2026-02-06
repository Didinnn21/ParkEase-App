<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use App\Models\ParkingHistory; // Pastikan Model ini wujud
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Kad Utama (Statistik Asas)
        $totalLocations = ParkingLocation::count();
        $totalCapacity = ParkingLocation::sum('total_slots');
        $totalAvailable = ParkingLocation::sum('available_slots');

        $occupiedSlots = $totalCapacity - $totalAvailable;
        $occupancyRate = $totalCapacity > 0 ? ($occupiedSlots / $totalCapacity) * 100 : 0;

        // 2. Data untuk Grafik (Trend Aktivitas 7 Hari Terakhir)
        // Mengambil jumlah kendaraan masuk (decrement slot) per hari
        $chartData = ParkingHistory::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('action', 'decrement') // decrement = kendaraan masuk
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = $chartData->pluck('date');
        $chartValues = $chartData->pluck('total');

        // 3. Log Aktivitas Terbaru (Audit Trail)
        // Melihat 5 aksi terakhir yang dilakukan petugas
        $recentActivities = ParkingHistory::with(['user', 'location'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Lokasi Kritis (Hampir Penuh < 10% slot)
        $criticalLocations = ParkingLocation::whereRaw('(available_slots / total_slots) < 0.1')
            ->get();

        return view('admin.dashboard', compact(
            'totalLocations', 'totalCapacity', 'totalAvailable', 'occupancyRate',
            'chartLabels', 'chartValues', 'recentActivities', 'criticalLocations'
        ));
    }
}
