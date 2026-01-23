<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkEase Bandung - Riwayat</title>
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
                    <h1 class="text-2xl font-extrabold text-[#1A1A1A] leading-none text-blue-600">ParkEase</h1>
                    <p class="text-[11px] text-slate-400 font-bold mt-1 uppercase tracking-tight">Riwayat Parkir Bandung
                    </p>
                </div>
            </div>

            <div class="flex gap-3">
                <div
                    class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 font-bold text-xs border border-blue-100">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 mt-6">
        <h2 class="text-sm font-extrabold text-[#1A1A1A] mb-4">Aktivitas Kunjungan Terakhir</h2>

        <div class="space-y-4">
            @forelse($histories as $history)
                <div
                    class="bg-white rounded-[2rem] p-5 flex gap-4 border border-slate-100 shadow-sm relative group active:scale-[0.98] transition-all">
                    <div
                        class="absolute left-0 top-0 bottom-0 w-1.5 {{ $history->action == 'decrement' ? 'bg-[#2D7CF6]' : 'bg-green-500' }} rounded-l-full">
                    </div>

                    <div class="w-16 h-16 bg-[#F1F3F5] rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8 {{ $history->action == 'decrement' ? 'text-blue-500' : 'text-green-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <div class="flex justify-between items-start">
                            <h3 class="text-sm font-extrabold text-[#1A1A1A] leading-tight">
                                {{ $history->location->name ?? 'Gedung Bandung' }}
                            </h3>
                            <span class="text-[9px] font-black text-slate-300 uppercase whitespace-nowrap ml-2">
                                {{ $history->created_at->format('d M, H:i') }}
                            </span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium mt-1 leading-snug">
                            {{ $history->notes ?? 'Aktivitas parkir di area Bandung.' }}
                        </p>

                        <div class="mt-3 flex items-center gap-2">
                            <span
                                class="px-3 py-1 rounded-lg text-[9px] font-black uppercase {{ $history->action == 'decrement' ? 'bg-blue-50 text-blue-600' : 'bg-green-50 text-green-600' }}">
                                {{ $history->action == 'decrement' ? 'Masuk' : 'Keluar' }}
                            </span>
                            <span class="text-[9px] font-black text-slate-400 uppercase">
                                Sisa Slot: {{ $history->new_available }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-12 text-center border-2 border-dashed border-slate-200">
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Belum ada riwayat aktivitas di
                        Bandung.</p>
                </div>
            @endforelse
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
                class="text-[10px] font-extrabold {{ request()->routeIs('user.notifications') ? 'text-[#2D7CF6]' : 'text-slate-400' }} uppercase tracking-tighter">
                Notifikasi
            </span>
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
