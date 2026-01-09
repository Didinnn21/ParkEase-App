<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkEase - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen pb-28">

    <div class="bg-white px-6 pt-8 pb-4">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-[#2D7CF6] rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-[#1A1A1A] leading-none">ParkEase</h1>
                    <p class="text-[11px] text-slate-400 font-bold mt-1 uppercase tracking-tight">Cari Jakarta Sans</p>
                </div>
            </div>
            <div class="flex gap-3">
                <button class="text-slate-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg></button>
                <button class="text-slate-400"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
            </div>
        </div>

        <div class="relative mb-6">
            <input type="text" placeholder="cari lokasi parkir..."
                class="w-full bg-[#E9ECEF] border-none rounded-2xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-500 outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <button class="absolute right-4 top-1/2 -translate-y-1/2 bg-slate-300 p-1.5 rounded-lg">
                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/></svg>
            </button>
        </div>

        <div class="flex gap-2 overflow-x-auto hide-scrollbar pb-2">
            <button class="bg-[#2D7CF6] text-white px-5 py-2.5 rounded-xl text-xs font-bold whitespace-nowrap">Terdekat</button>
            <button class="bg-[#E9ECEF] text-slate-500 px-5 py-2.5 rounded-xl text-xs font-bold whitespace-nowrap">Bandung Tengah</button>
            <button class="bg-[#E9ECEF] text-slate-500 px-5 py-2.5 rounded-xl text-xs font-bold whitespace-nowrap">Mall</button>
            <button class="bg-[#E9ECEF] text-slate-500 px-5 py-2.5 rounded-xl text-xs font-bold whitespace-nowrap">Pasar Kal</button>
        </div>
        <div class="w-full h-1 bg-[#E9ECEF] rounded-full mt-1 relative">
            <div class="absolute left-0 top-0 h-full w-1/3 bg-blue-500 rounded-full"></div>
        </div>
    </div>

    <div class="px-6 mt-6">
        <h2 class="text-sm font-extrabold text-[#1A1A1A] mb-4">Lokasi Parkir di Sekitar Anda</h2>

        <div class="space-y-4">
            @forelse($locations as $loc)
            <div class="bg-white rounded-[2rem] p-5 flex gap-4 border border-slate-100 shadow-sm relative group active:scale-[0.98] transition-all">
                <div class="w-20 h-20 bg-[#F1F3F5] rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-10 h-10 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                </div>

                <div class="flex-1">
                    <p class="text-[10px] font-black text-slate-400">~3,7 km</p>
                    <h3 class="text-sm font-extrabold text-[#1A1A1A] leading-tight mt-0.5">{{ $loc->name }}</h3>
                    <p class="text-[10px] text-slate-400 font-medium mt-0.5 leading-snug">{{ Str::limit($loc->address, 40) }}</p>

                    <div class="mt-3 flex">
                        @if($loc->available_slots > 0)
                            <span class="bg-[#D1FADF] text-[#039855] text-[10px] font-black px-3 py-1 rounded-lg uppercase">
                                {{ $loc->available_slots }} slot tersedia
                            </span>
                        @else
                            <span class="bg-red-100 text-red-600 text-[10px] font-black px-3 py-1 rounded-lg uppercase">
                                Penuh
                            </span>
                        @endif
                    </div>
                </div>

                <button class="absolute bottom-5 right-5 w-10 h-10 bg-[#FF4D4D] rounded-xl flex items-center justify-center text-white shadow-lg shadow-red-100 transition-all group-hover:rotate-12">
                    <svg class="w-5 h-5 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </div>
            @empty
            <div class="bg-white rounded-3xl p-10 text-center border-2 border-dashed border-slate-200">
                <p class="text-slate-400 text-sm font-bold">Belum ada lokasi parkir.</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="fixed bottom-0 w-full bg-white border-t border-slate-100 px-6 py-4 flex justify-between items-center shadow-[0_-10px_20px_rgba(0,0,0,0.02)] z-50">
        <a href="#" class="flex flex-col items-center gap-1.5">
            <div class="w-12 h-10 bg-[#2D7CF6] rounded-xl flex items-center justify-center text-white">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
            </div>
            <span class="text-[10px] font-extrabold text-[#2D7CF6] uppercase tracking-tighter">Home</span>
        </a>
        <a href="#" class="flex flex-col items-center gap-1.5 group">
            <div class="w-12 h-10 bg-[#E9ECEF] rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-blue-50 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-tighter">Riwayat</span>
        </a>
        <a href="#" class="flex flex-col items-center gap-1.5 group">
            <div class="w-12 h-10 bg-[#E9ECEF] rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-blue-50 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-tighter">Notifikasi</span>
        </a>
        <a href="#" class="flex flex-col items-center gap-1.5 group">
            <div class="w-12 h-10 bg-[#E9ECEF] rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-blue-50 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-tighter">Profil</span>
        </a>
    </div>

</body>
</html>
