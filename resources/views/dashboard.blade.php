<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Parkir - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Pastikan elemen ini tidak menghalang klik */
        .click-through { pointer-events: none; }
        .click-enable { pointer-events: auto; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen pb-24 relative">

    <header class="bg-white sticky top-0 z-40 px-6 py-4 shadow-sm border-b border-slate-100">
        <div class="flex justify-between items-center max-w-md mx-auto">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <div>
                    <h1 class="font-black text-lg text-slate-900 leading-none">ParkEase</h1>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Cari Parkir Cepat</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="relative z-50">
                @csrf
                <button class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-colors cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-md mx-auto px-6 py-6 space-y-6 relative z-0">

        <div id="gps-status" class="bg-blue-50 border border-blue-100 p-4 rounded-2xl flex items-center gap-3 hidden">
            <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
            <p class="text-xs font-bold text-blue-700">Lokasi anda aktif.</p>
        </div>

        @if(!$isSorted)
        <div id="gps-request" class="bg-slate-900 text-white p-6 rounded-3xl relative overflow-hidden shadow-xl shadow-slate-200">
            <div class="relative z-30">
                <h3 class="font-bold text-lg mb-1">Aktifkan Lokasi</h3>
                <p class="text-slate-400 text-xs mb-4">Urutkan parkir dari yang paling dekat.</p>
                {{-- Tambah style cursor-pointer & relative z-50 --}}
                <button onclick="getLocation()" class="bg-white text-slate-900 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-slate-200 transition-colors cursor-pointer relative z-50">
                    Nyalakan GPS
                </button>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-600 rounded-full opacity-20 blur-2xl click-through z-0"></div>
        </div>
        @endif

        <div class="space-y-4">
            <h2 class="font-black text-slate-900 text-xl">
                {{ $isSorted ? 'Paling Dekat' : 'Semua Lokasi' }}
            </h2>

            @forelse($locations as $loc)
            {{-- Card Container --}}
            <div class="bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all group relative overflow-hidden">

                <div class="flex justify-between items-start mb-4 relative z-10">
                    <div>
                        <h3 class="font-bold text-slate-900 text-lg">{{ $loc->name }}</h3>
                        <p class="text-xs text-slate-400 font-medium flex items-center gap-1 mt-1">
                            {{ Str::limit($loc->address, 35) }}
                        </h3>
                    </div>
                    @if(isset($loc->distance))
                    <div class="bg-slate-900 text-white px-3 py-1.5 rounded-xl text-xs font-black">
                        {{ round($loc->distance, 1) }} KM
                    </div>
                    @endif
                </div>

                <div class="flex items-end justify-between relative z-30">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">KETERSEDIAAN</p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-3xl font-black {{ $loc->available_slots > 0 ? 'text-blue-600' : 'text-red-500' }}">
                                {{ $loc->available_slots }}
                            </span>
                            <span class="text-xs font-bold text-slate-300">/ {{ $loc->total_slots }} Slot</span>
                        </div>
                        <p class="text-xs font-bold text-slate-500 mt-1">
                            Rp {{ number_format($loc->price_per_hour, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Tombol Navigasi (Z-Index Tinggi & Cursor Pointer) --}}
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $loc->latitude }},{{ $loc->longitude }}" target="_blank"
                       class="w-12 h-12 rounded-full flex items-center justify-center transition-all shadow-lg relative z-50 cursor-pointer {{ $loc->available_slots > 0 ? 'bg-blue-600 text-white shadow-blue-500/30 hover:scale-110' : 'bg-slate-200 text-slate-400' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                {{-- Indikator Penuh (Gunakan pointer-events-none supaya boleh klik butang di bawahnya jika perlu) --}}
                @if($loc->available_slots == 0)
                <div class="absolute inset-0 bg-white/60 backdrop-blur-[1px] flex items-center justify-center z-20 click-through">
                    <span class="bg-red-500 text-white px-6 py-2 rounded-full font-black uppercase text-sm shadow-xl transform -rotate-12 border-2 border-white">PENUH</span>
                </div>
                @endif
            </div>
            @empty
            <div class="text-center py-10">
                <p class="text-slate-400 text-sm font-medium">Belum ada lokasi parkir.</p>
            </div>
            @endforelse
        </div>
    </main>

    <nav class="fixed bottom-0 w-full bg-white border-t border-slate-100 max-w-md mx-auto left-0 right-0 px-6 py-4 z-40">
        <div class="flex justify-around items-center">
            <a href="#" class="flex flex-col items-center gap-1 text-blue-600">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                <span class="text-[9px] font-black uppercase">Cari Parkir</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-1 text-slate-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span class="text-[9px] font-black uppercase">Riwayat</span>
            </a>
        </div>
    </nav>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Browser tidak menyokong GPS.");
            }
        }

        function showPosition(position) {
            window.location.search = `?lat=${position.coords.latitude}&lng=${position.coords.longitude}`;
        }

        function showError(error) {
            alert("Sila benarkan akses lokasi untuk fitur ini.");
        }

        // Cek jika sudah ada parameter lat/lng
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('lat') && urlParams.has('lng')) {
            document.getElementById('gps-status').classList.remove('hidden');
            const reqBox = document.getElementById('gps-request');
            if(reqBox) reqBox.style.display = 'none';
        }
    </script>
</body>
</html>
