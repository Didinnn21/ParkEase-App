<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cari Parkir - ParkEase</title>
    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Font: Plus Jakarta Sans (Sesuai Figma) --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-tap-highlight-color: transparent; /* Hilangkan highlight biru saat klik di mobile */
        }
        /* Utiliti untuk mengatur klik menembusi elemen */
        .pointer-events-none { pointer-events: none; }
        .pointer-events-auto { pointer-events: auto; }
        /* Sembunyikan scrollbar tapi tetap bisa scroll */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    <script>
        // Kustomisasi warna Tailwind sesuai Figma ParkEase
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#2D7CF6', dark: '#1A68D8', light: '#EAF2FF' },
                        dark: { DEFAULT: '#1A1A1A', softer: '#2B2B2B' },
                        slate: { 50: '#F8F9FA', 100: '#E9ECEF', 400: '#CED4DA', 500: '#ADB5BD', 900: '#212529' }
                    },
                    borderRadius: {
                        '3xl': '1.5rem',
                        '4xl': '2rem',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 min-h-screen">

    <div class="max-w-md mx-auto bg-[#F8F9FA] min-h-screen relative shadow-2xl shadow-slate-200/50 pb-24">

        <header class="sticky top-0 bg-[#F8F9FA]/80 backdrop-blur-md z-40 px-6 pt-8 pb-4">
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 animate-fade-in-down">
                    <div class="w-12 h-12 bg-primary rounded-2xl flex items-center justify-center text-white shadow-lg shadow-primary/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-dark leading-none tracking-tight">ParkEase</h1>
                        <p class="text-[11px] text-slate-500 font-bold uppercase tracking-widest mt-1.5">Asisten Parkir Pintar</p>
                    </div>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-11 h-11 rounded-full bg-white border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 hover:border-red-100 transition-all active:scale-95 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>

            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-12 pr-4 py-4 bg-white border border-slate-100 rounded-3xl text-sm font-semibold text-dark placeholder-slate-400 shadow-sm focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" placeholder="Cari lokasi parkir...">
            </div>
        </header>

        <main class="px-6 space-y-6">
            @if(!$isSorted)
            <div id="gps-card" class="bg-dark rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl shadow-dark/20 animate-fade-in-up">
                <div class="relative z-10">
                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center mb-4 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="font-extrabold text-xl mb-2 leading-tight">Cari parkir terdekat dengan posisi Anda?</h3>
                    <p class="text-slate-400 text-sm mb-6 leading-relaxed">Izinkan akses lokasi untuk mengurutkan rekomendasi parkir terbaik di sekitar.</p>
                    <button onclick="getLocation()" id="btn-gps" class="bg-primary text-white px-8 py-4 rounded-2xl text-sm font-bold uppercase tracking-wider hover:bg-primary-dark active:scale-95 transition-all w-full sm:w-auto shadow-lg shadow-primary/30 relative overflow-hidden group">
                        <span class="relative z-10">Nyalakan GPS Sekarang</span>
                        <div class="absolute inset-0 h-full w-0 bg-white/20 transition-all duration-300 group-hover:w-full"></div>
                    </button>
                </div>
                <div class="absolute -right-10 -bottom-20 w-64 h-64 bg-primary rounded-full opacity-20 blur-3xl pointer-events-none mix-blend-screen"></div>
                <div class="absolute -left-10 -top-20 w-64 h-64 bg-purple-500 rounded-full opacity-10 blur-3xl pointer-events-none mix-blend-screen"></div>
            </div>
            @else
            <div class="bg-primary-light/50 border border-primary-light p-5 rounded-3xl flex items-center gap-4 animate-fade-in-down">
                <div class="relative flex h-5 w-5">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-5 w-5 bg-primary"></span>
                </div>
                <div>
                    <p class="text-sm font-extrabold text-primary-dark">Mode GPS Aktif</p>
                    <p class="text-xs font-medium text-blue-600/70">Menampilkan hasil berdasarkan lokasi real-time.</p>
                </div>
            </div>
            @endif

            <div>
                <div class="flex justify-between items-center mb-4 px-1">
                    <h2 class="font-extrabold text-dark text-lg">Rekomendasi Parkir</h2>
                    <span class="text-xs font-bold text-slate-400">{{ $locations->count() }} Lokasi Ditemukan</span>
                </div>

                <div class="space-y-5 pb-4">
                    @forelse($locations as $loc)
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative group">

                        <div class="flex justify-between items-start mb-5 pr-14 relative z-10">
                            <div>
                                <h3 class="font-extrabold text-dark text-xl leading-tight mb-2">{{ $loc->name }}</h3>
                                <div class="flex items-start gap-1.5">
                                    <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <p class="text-xs text-slate-500 font-medium leading-snug line-clamp-2">{{ $loc->address }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-end justify-between pt-4 border-t border-slate-50 relative z-10">
                            <div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1.5">TARIF PER JAM</p>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-sm font-bold text-primary">Rp</span>
                                    <span class="text-2xl font-extrabold text-dark">{{ number_format($loc->price_per_hour, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="text-right">
                                 <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1.5">KAPASITAS REAL-TIME</p>
                                 <div class="flex items-center gap-1.5 justify-end">
                                    <div class="w-2.5 h-2.5 rounded-full {{ $loc->available_slots > 0 ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}"></div>
                                    <span class="text-2xl font-extrabold {{ $loc->available_slots > 0 ? 'text-dark' : 'text-red-500' }}">
                                        {{ $loc->available_slots }}
                                    </span>
                                    <span class="text-xs font-bold text-slate-400">/ {{ $loc->total_slots }}</span>
                                 </div>
                            </div>
                        </div>

                        @if(isset($loc->distance))
                        <div class="absolute top-6 right-6 bg-dark text-white px-3 py-1.5 rounded-full text-[10px] font-extrabold tracking-wide shadow-md z-20">
                            {{ number_format($loc->distance, 1) }} KM
                        </div>
                        @endif

                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $loc->latitude }},{{ $loc->longitude }}"
                           target="_blank"
                           class="absolute -top-3 -right-3 w-14 h-14 bg-primary text-white rounded-2xl flex items-center justify-center shadow-lg shadow-primary/30 transition-all hover:scale-110 active:scale-95 z-30 pointer-events-auto group-hover:rotate-12">
                            <svg class="w-7 h-7 transition-transform group-hover:-rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>

                        @if($loc->available_slots == 0)
                        <div class="absolute inset-0 bg-white/80 backdrop-blur-[2px] z-20 flex items-center justify-center rounded-[2rem] pointer-events-none transition-all duration-300 group-hover:bg-white/60">
                            <span class="bg-red-500 text-white px-6 py-2.5 rounded-full font-black uppercase text-sm tracking-wider shadow-2xl transform -rotate-12 border-4 border-white ring-2 ring-red-500/30">
                                PENUH TOTAL
                            </span>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="bg-white rounded-[2.5rem] p-12 text-center border border-dashed border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-dark font-bold text-lg mb-2">Belum Ada Data</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Oops! Sepertinya belum ada lokasi parkir yang tersedia di area ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>

        <nav class="fixed bottom-0 inset-x-0 bg-white/90 backdrop-blur-md border-t border-slate-100 py-4 px-8 z-50 max-w-md mx-auto rounded-t-[2rem] shadow-[0_-5px_20px_-5px_rgba(0,0,0,0.05)]">
            <div class="flex justify-around items-center relative">
                <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center gap-1.5 text-primary group relative z-10 w-20">
                    <div class="absolute -inset-x-2 -inset-y-1 bg-primary-light rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity -z-10 scale-95 group-hover:scale-100 duration-300"></div>
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider">Eksplor</span>
                </a>

                <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center absolute left-1/2 -translate-x-1/2 -top-8 shadow-lg shadow-primary/40 border-4 border-white cursor-pointer hover:scale-105 transition-transform active:scale-95">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                </div>

                <a href="#" class="flex flex-col items-center gap-1.5 text-slate-300 hover:text-slate-500 transition-colors group relative z-10 w-20">
                     <div class="absolute -inset-x-2 -inset-y-1 bg-slate-100 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity -z-10 scale-95 group-hover:scale-100 duration-300"></div>
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider">Aktivitas</span>
                </a>
            </div>
        </nav>

    </div> <script>
        function getLocation() {
            if (navigator.geolocation) {
                const btn = document.getElementById('btn-gps');
                const btnText = btn.querySelector('span');

                // Ubah tampilan tombol saat loading
                btn.disabled = true;
                btnText.innerHTML = 'Sedang Mencari Lokasi...';
                btn.classList.add('opacity-80', 'cursor-not-allowed');

                navigator.geolocation.getCurrentPosition(showPosition, showError, {
                    enableHighAccuracy: true, // Minta akurasi tinggi
                    timeout: 15000, // Waktu tunggu 15 detik
                    maximumAge: 0 // Jangan guna cache lokasi lama
                });
            } else {
                alert("Maaf, browser Anda tidak mendukung fitur GPS.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            // Redirect dan kirim koordinat ke server
            window.location.search = `?lat=${lat}&lng=${lng}`;
        }

        function showError(error) {
            let msg = "";
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    msg = "Akses lokasi ditolak. Mohon izinkan akses GPS di pengaturan browser Anda untuk menggunakan fitur ini.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    msg = "Informasi lokasi tidak tersedia saat ini. Coba lagi nanti.";
                    break;
                case error.TIMEOUT:
                    msg = "Waktu permintaan lokasi habis. Pastikan sinyal GPS Anda baik.";
                    break;
                default:
                    msg = "Terjadi kesalahan yang tidak diketahui saat mengambil lokasi.";
            }
            alert(msg);

            // Reset tombol ke kondisi semula
            const btn = document.getElementById('btn-gps');
            const btnText = btn.querySelector('span');
            btn.disabled = false;
            btnText.innerHTML = 'Nyalakan GPS Sekarang';
            btn.classList.remove('opacity-80', 'cursor-not-allowed');
        }
    </script>
</body>
</html>
