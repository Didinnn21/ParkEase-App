@extends('layouts.admin')

<<<<<<< HEAD
@section('content')
    <div class="p-6">
        <div class="mb-8">
            <h1 class="text-2xl font-extrabold text-slate-800">Dashboard Ringkasan</h1>
            <p class="text-slate-500 text-sm">Selamat datang kembali, Admin ParkEase.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Lokasi</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $total_locations ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Petugas Aktif</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $total_petugas ?? 0 }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Slot Tersedia</p>
                        <h3 class="text-2xl font-black text-slate-800">{{ $total_slots ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                <h2 class="font-bold text-slate-800">Status Parkir Real-Time</h2>
                <a href="{{ route('admin.locations.index') }}" class="text-xs font-bold text-blue-600">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] uppercase font-bold text-slate-400">
                        <tr>
                            <th class="px-6 py-4">Nama Lokasi</th>
                            <th class="px-6 py-4">Kapasitas</th>
                            <th class="px-6 py-4">Tersedia</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($locations as $loc)
                            <tr class="text-sm">
                                <td class="px-6 py-4 font-bold text-slate-700">{{ $loc->name }}</td>
                                <td class="px-6 py-4 text-slate-500">{{ $loc->total_slots }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-bold {{ $loc->available_slots < 5 ? 'text-red-500' : 'text-slate-700' }}">
                                        {{ $loc->available_slots }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $loc->status == 'open' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ $loc->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">Belum ada data lokasi parkir.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
=======
@section('title', 'Dashboard Utama')

@section('content')
{{-- Muat Chart.js dari CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-8">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Dashboard Overview</h2>
            <p class="text-slate-400 font-medium">Laporan analitik dan pemantauan realtime.</p>
        </div>
        <div class="flex gap-2">
            <button onclick="window.print()" class="bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-slate-50">
                Cetak Laporan
            </button>
            <a href="{{ route('admin.locations.create') }}" class="bg-slate-900 text-white px-6 py-3 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-slate-800 shadow-lg shadow-slate-900/20">
                + Lokasi Baru
            </a>
        </div>
    </div>

    @if($criticalLocations->count() > 0)
    <div class="bg-red-50 border border-red-100 p-4 rounded-2xl flex items-start gap-4 animate-pulse">
        <div class="bg-red-500 text-white p-2 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <h4 class="font-bold text-red-700 text-sm">PERHATIAN: {{ $criticalLocations->count() }} Lokasi Hampir Penuh!</h4>
            <p class="text-xs text-red-600 mt-1">Segera alihkan lalu lintas dari:
                @foreach($criticalLocations as $loc)
                    <span class="font-bold underline">{{ $loc->name }}</span>{{ !$loop->last ? ',' : '' }}
                @endforeach
            </p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="absolute right-0 top-0 p-4 opacity-5">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">TOTAL LOKASI</p>
            <h3 class="text-4xl font-black text-slate-900 mt-2">{{ $totalLocations }}</h3>
            <div class="mt-4 flex items-center gap-2 text-xs font-bold text-green-600 bg-green-50 w-fit px-2 py-1 rounded-lg">
                <span>● Aktif Beroperasi</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">TINGKAT OKUPANSI</p>
            <div class="flex items-end gap-2 mt-2">
                <h3 class="text-4xl font-black text-slate-900">{{ round($occupancyRate) }}%</h3>
                <span class="text-sm font-bold text-slate-400 mb-1">Terisi</span>
            </div>
            <div class="w-full bg-slate-100 h-2 rounded-full mt-4 overflow-hidden">
                <div class="h-full {{ $occupancyRate > 80 ? 'bg-red-500' : 'bg-blue-600' }}" style="width: {{ $occupancyRate }}%"></div>
            </div>
        </div>

        <div class="bg-blue-600 p-6 rounded-3xl text-white shadow-lg shadow-blue-200">
            <p class="text-blue-200 text-[10px] font-black uppercase tracking-widest">SLOT TERSEDIA</p>
            <h3 class="text-4xl font-black mt-2">{{ $totalAvailable }}</h3>
            <p class="text-xs font-medium text-blue-100 mt-2">Kapasitas Total: {{ $totalCapacity }}</p>
        </div>

        <div class="bg-slate-900 p-6 rounded-3xl text-white flex flex-col justify-center items-center text-center">
            <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-sm font-bold hover:underline">Kelola Petugas →</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-slate-900">Trend Kendaraan Masuk (7 Hari)</h3>
                <span class="text-xs font-bold text-slate-400 bg-slate-50 px-3 py-1 rounded-full">Weekly Report</span>
            </div>
            <div class="h-64">
                <canvas id="parkingTrendChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm h-fit">
            <h3 class="font-bold text-slate-900 mb-6">Aktivitas Petugas Terbaru</h3>
            <div class="space-y-6 relative before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-100">
                @forelse($recentActivities as $history)
                <div class="relative pl-8">
                    <div class="absolute left-0 top-1 w-4 h-4 rounded-full border-2 border-white {{ $history->action == 'decrement' ? 'bg-blue-500' : 'bg-orange-500' }}"></div>
                    <p class="text-xs font-bold text-slate-900">
                        {{ $history->user->name ?? 'Sistem' }}
                        <span class="font-normal text-slate-500">
                            {{ $history->action == 'decrement' ? 'memasukkan kendaraan ke' : 'mengeluarkan kendaraan dari' }}
                        </span>
                    </p>
                    <p class="text-xs font-bold text-blue-600 mt-0.5">{{ $history->location->name ?? 'Lokasi Dihapus' }}</p>
                    <span class="text-[10px] text-slate-400 font-mono mt-1 block">{{ $history->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <p class="text-sm text-slate-400 pl-4">Belum ada aktivitas tercatat.</p>
                @endforelse
            </div>
            <div class="mt-6 pt-6 border-t border-slate-50 text-center">
                <button class="text-xs font-bold text-slate-400 hover:text-slate-900 transition-colors">Lihat Semua Log →</button>
            </div>
        </div>
    </div>

</div>

<script>
    const ctx = document.getElementById('parkingTrendChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            // Data dari Controller
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Kendaraan Masuk',
                data: {!! json_encode($chartValues) !!},
                borderColor: '#2563EB', // Blue-600
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 3,
                tension: 0.4, // Garis lengkung
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#2563EB',
                pointBorderWidth: 2,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [2, 2], drawBorder: false }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endsection
>>>>>>> 1562099bb012a5bdb015e6a32a7d68e3cc5b0af1
