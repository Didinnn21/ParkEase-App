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
                    <p class="text-[11px] text-slate-400 font-bold mt-1 uppercase tracking-tight">Cari Parkir Cepat</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-10 h-10 rounded-full bg-red-50 text-red-400 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>

        <div class="relative mb-6">
            <input type="text" placeholder="Cari lokasi parkir..."
                class="w-full bg-[#E9ECEF] border-none rounded-2xl py-4 pl-12 pr-4 text-sm font-semibold text-slate-500 outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>

        @if(!$isSorted)
        <div id="gps-request-box" class="bg-slate-900 rounded-[2rem] p-6 text-white relative overflow-hidden shadow-xl mb-6">
            <div class="relative z-10">
                <h3 class="font-bold text-lg mb-1">Cari Terdekat?</h3>
                <p class="text-slate-400 text-xs mb-4">Izinkan lokasi untuk melihat jarak parkir dari posisi Anda.</p>
                <button onclick="getLocation()" class="bg-white text-slate-900 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-all w-full sm:w-auto">
                    NYALAKAN GPS
                </button>
            </div>
            <div class="absolute -right-5 -bottom-10 w-32 h-32 bg-blue-600 rounded-full opacity-20 blur-2xl pointer-events-none"></div>
        </div>
        @else
        <div class="bg-green-50 border border-green-100 p-4 rounded-2xl flex items-center gap-3 mb-6 animate-pulse">
            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
            <p class="text-xs font-bold text-green-700">GPS Aktif: Menampilkan lokasi terdekat.</p>
        </div>
        @endif
        </div>

    <div class="px-6 mt-2">
        <h2 class="text-sm font-extrabold text-[#1A1A1A] mb-4">Daftar Lokasi Parkir</h2>

        <div class="space-y-4">
            @forelse($locations as $loc)
            <div class="bg-white rounded-[2rem] p-5 flex gap-4 border border-slate-100 shadow-sm relative group active:scale-[0.98] transition-all">
                <div class="w-20 h-20 bg-[#F1F3F5] rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-10 h-10 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                </div>

                <div class="flex-1">
                    @if(isset($loc->distance))
                        <p class="text-[10px] font-black text-blue-600 bg-blue-50 w-fit px-2 py-0.5 rounded-md mb-1">{{ number_format($loc->distance, 1) }} km</p>
                    @endif
                    <h3 class="text-sm font-extrabold text-[#1A1A1A] leading-tight mt-0.5">{{ $loc->name }}</h3>
                    <p class="text-[10px] text-slate-400 font-medium mt-0.5 leading-snug">{{ Str::limit($loc->address, 35) }}</p>

                    <div class="mt-3 flex justify-between items-center pr-12">
                         <span class="text-xs font-bold text-slate-700">Rp {{ number_format($loc->price_per_hour, 0, ',', '.') }}</span>

                        @if($loc->available_slots > 0)
                            <span class="text-[10px] font-black text-green-600 uppercase">{{ $loc->available_slots }} Slot</span>
                        @else
                            <span class="text-[10px] font-black text-red-600 uppercase">Penuh</span>
                        @endif
                    </div>
                </div>

                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $loc->latitude }},{{ $loc->longitude }}"
                   target="_blank"
                   class="absolute bottom-5 right-5 w-10 h-10 bg-[#2D7CF6] rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-100 transition-all active:scale-90 z-20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>

                @if($loc->available_slots == 0)
                <div class="absolute inset-0 bg-white/70 backdrop-blur-[1px] z-10 flex items-center justify-center rounded-[2rem] pointer-events-none">
                     <span class="bg-red-500 text-white px-4 py-1 rounded-lg font-black text-xs -rotate-6 shadow-xl">PENUH</span>
                </div>
                @endif
            </div>
            @empty
            <div class="bg-white rounded-3xl p-10 text-center border-2 border-dashed border-slate-200">
                <p class="text-slate-400 text-sm font-bold">Belum ada lokasi parkir.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                // Ubah teks tombol jadi loading
                const btn = document.querySelector('button[onclick="getLocation()"]');
                if(btn) {
                    btn.innerHTML = 'MENCARI...';
                    btn.disabled = true;
                }

                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Browser tidak support GPS.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            // Reload halaman, kirim koordinat ke Controller
            window.location.search = `?lat=${lat}&lng=${lng}`;
        }

        function showError(error) {
            alert("Gagal mendapatkan lokasi. Pastikan GPS aktif.");
            const btn = document.querySelector('button[onclick="getLocation()"]');
            if(btn) {
                btn.innerHTML = 'NYALAKAN GPS';
                btn.disabled = false;
            }
        }
    </script>

</body>
</html>
