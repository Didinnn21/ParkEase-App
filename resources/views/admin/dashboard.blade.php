@extends('layouts.admin')

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