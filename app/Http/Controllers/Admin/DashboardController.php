<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParkingLocation;
use App\Models\ParkingHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Statistik Utama
        $totalLocations = ParkingLocation::count();
        $totalCapacity  = ParkingLocation::sum('total_slots');
        $totalAvailable = ParkingLocation::sum('available_slots');

        // Hitung Okupansi (Pastikan tidak dibagi 0)
        $occupiedSlots = $totalCapacity - $totalAvailable;
        $occupancyRate = $totalCapacity > 0 ? ($occupiedSlots / $totalCapacity) * 100 : 0;

        // 2. Data Grafik (Looping 7 Hari Terakhir agar data lengkap)
        $chartLabels = [];
        $chartValues = [];

        // Loop dari 6 hari lalu sampai hari ini
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            // Format Label: "04 Feb"
            $chartLabels[] = $date->format('d M');

            // Hitung kendaraan masuk pada tanggal tersebut
            $count = ParkingHistory::whereDate('created_at', $date)
                ->where('action', 'decrement') // decrement = kendaraan masuk
                ->count();

            $chartValues[] = $count;
        }

        // 3. Log Aktivitas Terbaru (Eager Loading User & Location)
        $recentActivities = ParkingHistory::with(['user', 'location'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Lokasi Kritis (Hampir Penuh < 10% slot)
        // Tambahkan where 'total_slots > 0' untuk mencegah error SQL Division by Zero
        $criticalLocations = ParkingLocation::where('total_slots', '>', 0)
            ->whereRaw('(available_slots / total_slots) < 0.1')
            ->get();

        // Kirim semua variabel ke View
        return view('admin.dashboard', compact(
            'totalLocations',
            'totalCapacity',
            'totalAvailable',
            'occupancyRate',
            'chartLabels',
            'chartValues',
            'recentActivities',
            'criticalLocations'
        ));
    }
}
