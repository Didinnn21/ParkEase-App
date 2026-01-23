<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ParkEase</title>
    {{-- Gunakan Vite jika boleh, tapi CDN ini okey untuk development pantas --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen">

    <aside class="hidden lg:flex w-72 bg-slate-900 flex-col fixed h-full z-50">
        <div class="p-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <span class="text-xl font-black text-white tracking-tight">ParkEase</span>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-2 mt-4">
            {{-- Menu Active State --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 bg-blue-600 text-white px-4 py-3.5 rounded-2xl font-bold shadow-lg shadow-blue-900/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="#" class="flex items-center gap-3 text-slate-400 hover:bg-slate-800 hover:text-white px-4 py-3.5 rounded-2xl font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Kelola Lokasi
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 text-slate-400 hover:bg-slate-800 hover:text-white px-4 py-3.5 rounded-2xl font-bold transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Data Petugas & User
            </a>
        </nav>

        <div class="p-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-500/10 text-red-500 py-4 rounded-2xl font-bold hover:bg-red-500 hover:text-white transition-all">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 lg:ml-72 flex flex-col">

        <header class="bg-white border-b border-slate-100 sticky top-0 z-40 px-6 py-4 flex justify-between items-center lg:px-12">
            <div class="flex items-center gap-4 lg:hidden">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </div>
                <span class="text-lg font-black text-slate-900 tracking-tight">ParkEase</span>
            </div>

            <div class="hidden lg:block text-slate-400 text-sm font-medium italic">
                Pusat Kendali Administrasi ParkEase
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-black text-slate-900 uppercase leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-blue-600 font-bold uppercase mt-1">Administrator</p>
                </div>
                <div class="w-10 h-10 bg-slate-100 rounded-full border-2 border-white shadow-sm overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" alt="Profile">
                </div>
            </div>
        </header>

        <main class="p-6 lg:p-12 pb-32 lg:pb-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Dashboard Utama</h2>
                    <p class="text-slate-400 font-medium mt-1">Pantau performa dan ketersediaan slot parkir hari ini.</p>
                </div>
                <div class="flex gap-3">
                    <button class="bg-white text-slate-900 border border-slate-200 px-6 py-4 rounded-2xl font-bold text-xs shadow-sm hover:bg-slate-50 transition-all uppercase tracking-widest">Laporan</button>
        <a href="{{ route('admin.locations.index') }}" class="bg-blue-600 text-white px-6 py-4 rounded-2xl font-bold text-xs shadow-lg shadow-blue-200 hover:bg-blue-700 active:scale-95 transition-all uppercase tracking-widest inline-flex items-center justify-center">
                + Lokasi Baru</a>
                       </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                        <svg class="w-20 h-20 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">Total Lokasi</p>
                    <h3 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter">{{ $total_locations }} <span class="text-sm font-bold text-slate-300">Titik</span></h3>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group">
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">Total Kapasitas</p>
                    <div class="flex items-end gap-2 mt-2">
                         <h3 class="text-4xl font-black text-slate-900 tracking-tighter">{{ $total_capacity }}</h3>
                         <span class="text-sm font-bold text-slate-300 mb-2">Slot</span>
                    </div>

                    <div class="flex justify-between items-end mt-4 mb-1">
                        <span class="text-[10px] font-bold text-slate-400">Terisi {{ $occupancy_rate }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                        {{-- Bar ini sekarang bergerak mengikut data sebenar --}}
                        <div class="bg-blue-600 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $occupancy_rate }}%"></div>
                    </div>
                </div>

                <div class="bg-slate-900 p-8 rounded-[2rem] text-white shadow-xl shadow-slate-200 relative md:col-span-2 lg:col-span-1">
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">Slot Tersedia (Realtime)</p>
                    <div class="flex items-end gap-3 mt-2">
                        <h3 class="text-4xl font-black tracking-tighter">{{ $total_available }}</h3>
                        <span class="bg-green-500/20 text-green-400 text-[10px] font-black px-2 py-1 rounded-md mb-2 animate-pulse">LIVE</span>
                    </div>
                    <p class="text-slate-500 text-xs mt-3 font-medium italic">Data diperbarui setiap kendaraan masuk/keluar.</p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <h4 class="font-black text-slate-900 uppercase tracking-tight text-lg">Status Kepadatan Lokasi</h4>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sistem Aktif</span>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left min-w-[600px]">
                        <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">
                            <tr>
                                <th class="px-8 py-5">Lokasi Parkir</th>
                                <th class="px-8 py-5">Alamat</th>
                                <th class="px-8 py-5 text-center">Okupansi</th>
                                <th class="px-8 py-5 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($locations as $loc)
                            @php
                                $used = $loc->total_slots - $loc->available_slots;
                                $percent = $loc->total_slots > 0 ? ($used / $loc->total_slots) * 100 : 0;
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-6 font-bold text-slate-900">{{ $loc->name }}</td>
                                <td class="px-8 py-6 text-slate-400 text-xs font-medium">{{ Str::limit($loc->address, 30) }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col items-center gap-1">
                                        <span class="text-[10px] font-black text-slate-900">{{ $used }} / {{ $loc->total_slots }}</span>
                                        <div class="w-24 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                            <div class="h-full {{ $percent > 90 ? 'bg-red-500' : 'bg-blue-600' }}" style="width: {{ $percent }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase {{ $loc->available_slots > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ $loc->available_slots > 0 ? 'Tersedia' : 'Penuh' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-12 text-center text-slate-400 text-sm font-medium">Belum ada lokasi parkir yang didaftarkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <nav class="lg:hidden fixed bottom-0 w-full bg-white border-t border-slate-100 px-6 py-4 flex justify-around items-center z-50">
            <a href="#" class="flex flex-col items-center gap-1 text-blue-600">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                <span class="text-[9px] font-black uppercase">Home</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-1 text-slate-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="text-[9px] font-black uppercase">Lokasi</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="flex flex-col items-center">
                @csrf
                <button type="submit" class="flex flex-col items-center gap-1 text-red-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="text-[9px] font-black uppercase">Keluar</span>
                </button>
            </form>
        </nav>
    </div>

</body>
</html>
