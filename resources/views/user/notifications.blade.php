<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkEase Bandung - Notifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F9FA] min-h-screen pb-28">

    <div class="bg-white px-6 pt-8 pb-4 border-b border-slate-50 sticky top-0 z-50">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center overflow-hidden shadow-sm border border-slate-50">
                    <img src="{{ asset('assets/img/Logo_ParkEasy.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-[#1A1A1A] leading-none text-[#2D7CF6]">ParkEase</h1>
                    <p class="text-[11px] text-slate-400 font-bold mt-1 uppercase tracking-tight">Pusat Notifikasi</p>
                </div>
            </div>
            <div
                class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-[#2D7CF6] font-bold text-xs border border-blue-100">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        </div>
    </div>

    <div class="px-6 mt-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-sm font-extrabold text-[#1A1A1A]">Terbaru</h2>
            <button class="text-[10px] font-bold text-[#2D7CF6] uppercase tracking-tighter">Tandai Dibaca</button>
        </div>

        <div class="space-y-4">
            <div
                class="bg-white rounded-[2rem] p-5 flex gap-4 border border-slate-100 shadow-sm relative overflow-hidden group transition-all">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#2D7CF6] rounded-l-full"></div>
                <div
                    class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center flex-shrink-0 text-[#2D7CF6]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <h3 class="text-sm font-extrabold text-[#1A1A1A] leading-tight">Parkir Berhasil Dicatat</h3>
                        <span class="text-[9px] font-black text-slate-300 uppercase whitespace-nowrap ml-2">Baru
                            Saja</span>
                    </div>
                    <p class="text-[10px] text-slate-400 font-medium mt-1 leading-snug">Kendaraan Anda telah masuk ke
                        lokasi Gedung Sate Park. Selamat beraktivitas!</p>
                </div>
            </div>

            <div
                class="bg-white rounded-[2rem] p-5 flex gap-4 border border-slate-100 shadow-sm relative overflow-hidden opacity-70 transition-all">
                <div
                    class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center flex-shrink-0 text-slate-400">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                        </path>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <h3 class="text-sm font-extrabold text-[#1A1A1A] leading-tight">Update Area Bandung</h3>
                        <span class="text-[9px] font-black text-slate-300 uppercase whitespace-nowrap ml-2">2 Jam
                            Lalu</span>
                    </div>
                    <p class="text-[10px] text-slate-400 font-medium mt-1 leading-snug">Sistem ParkEase kini tersedia di
                        area Paris Van Java (PVN). Cek ketersediaan sekarang!</p>
                </div>
            </div>
        </div>
    </div>

    <div
        class="fixed bottom-0 w-full bg-white border-t border-slate-100 px-6 py-4 flex justify-between items-center shadow-[0_-10px_20px_rgba(0,0,0,0.02)] z-50">
        <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center gap-1.5 group">
            <div
                class="w-12 h-10 {{ request()->routeIs('user.dashboard') ? 'bg-[#2D7CF6] text-white shadow-lg shadow-blue-100' : 'bg-[#E9ECEF] text-slate-400 group-hover:bg-blue-50' }} rounded-xl flex items-center justify-center transition-all duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
            </div>
            <span
                class="text-[10px] font-extrabold {{ request()->routeIs('user.dashboard') ? 'text-[#2D7CF6]' : 'text-slate-400' }} uppercase tracking-tighter">Home</span>
        </a>

        <a href="{{ route('user.history') }}" class="flex flex-col items-center gap-1.5 group">
            <div
                class="w-12 h-10 {{ request()->routeIs('user.history') ? 'bg-[#2D7CF6] text-white shadow-lg shadow-blue-100' : 'bg-[#E9ECEF] text-slate-400 group-hover:bg-blue-50' }} rounded-xl flex items-center justify-center transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span
                class="text-[10px] font-extrabold {{ request()->routeIs('user.history') ? 'text-[#2D7CF6]' : 'text-slate-400' }} uppercase tracking-tighter">Riwayat</span>
        </a>

        <a href="{{ route('user.notifications') }}" class="flex flex-col items-center gap-1.5 group">
            <div
                class="w-12 h-10 {{ request()->routeIs('user.notifications') ? 'bg-[#2D7CF6] text-white shadow-lg shadow-blue-100' : 'bg-[#E9ECEF] text-slate-400 group-hover:bg-blue-50' }} rounded-xl flex items-center justify-center transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
            </div>
            <span
                class="text-[10px] font-extrabold {{ request()->routeIs('user.notifications') ? 'text-[#2D7CF6]' : 'text-slate-400' }} uppercase tracking-tighter">Notifikasi</span>
        </a>

        <a href="{{ route('user.profile') }}" class="flex flex-col items-center gap-1.5 group">
            <div
                class="w-12 h-10 bg-[#E9ECEF] text-slate-400 group-hover:bg-blue-50 rounded-xl flex items-center justify-center transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-tighter">Profil</span>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="flex flex-col items-center gap-1.5 group">
            @csrf
            <button type="submit"
                class="w-12 h-10 bg-[#E9ECEF] rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-red-50 group-hover:text-red-500 transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
            </button>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-tighter">Logout</span>
        </form>
    </div>

</body>

</html>
