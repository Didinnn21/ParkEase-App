<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkEase Bandung - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-[#F8F9FA] min-h-screen pb-28">

    {{-- HEADER & SEARCH --}}
    <div class="bg-white px-6 pt-8 pb-4 border-b border-slate-50 sticky top-0 z-50">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center overflow-hidden shadow-sm border border-slate-50">
                    <img src="{{ asset('assets/img/Logo_ParkEasy.jpeg') }}" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-blue-600 leading-none">ParkEase</h1>
                    <p class="text-[11px] text-slate-400 font-bold mt-1 uppercase tracking-tight">Cari Parkir Bandung</p>
                </div>
            </div>

            <a href="{{ route('user.profile') }}" class="w-10 h-10 rounded-full overflow-hidden border border-blue-100 shadow-sm flex items-center justify-center bg-blue-50">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                @else
                    <span class="text-blue-600 font-bold text-xs">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                @endif
            </a>
        </div>

        {{-- FORM PENCARIAN --}}
        <form action="{{ route('user.dashboard') }}" method="GET" class="relative mb-6" id="searchForm">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            {{-- Hidden input untuk menyimpan koordinat GPS --}}
            <input type="hidden" name="lat" id="latInput" value="{{ request('lat') }}">
            <input type="hidden" name="lng" id="lngInput" value="{{ request('lng') }}">

            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="cari lokasi parkir di bandung..."
                class="w-full bg-[#E9ECEF] border-none rounded-2xl py-4 pl-12 pr-4 text-sm font-semibold text-[#1A1A1A] outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </form>

        {{-- FILTER KATEGORI --}}
        <div class="flex gap-2 overflow-x-auto hide-scrollbar pb-2">
            @php
                $menus = [
                    ['label' => 'Terdekat', 'slug' => 'semua'],
                    ['label' => 'Bandung Tengah', 'slug' => 'bandung_tengah'],
                    ['label' => 'Mall', 'slug' => 'mall'],
                    ['label' => 'Pasar', 'slug' => 'pasar'],
                ];
            @endphp

            @foreach($menus as $menu)
                <a href="{{ route('user.dashboard', ['category' => $menu['slug'], 'search' => request('search')]) }}"
                   onclick="applyLocationFilter(event, '{{ $menu['slug'] }}')"
                   class="px-5 py-2.5 rounded-xl text-xs font-bold whitespace-nowrap transition-all
                   {{ (request('category') == $menu['slug'] || (!request('category') && $menu['slug'] == 'semua'))
                        ? 'bg-[#2D7CF6] text-white shadow-lg shadow-blue-100'
                        : 'bg-[#E9ECEF] text-slate-500 hover:bg-slate-200' }}">
                    {{ $menu['label'] }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- LIST LOKASI --}}
    <div class="px-6 mt-6">
        <h2 class="text-sm font-extrabold text-[#1A1A1A] mb-4 uppercase tracking-wider">
            {{ request('search') ? 'Hasil Pencarian: "' . request('search') . '"' : 'Rekomendasi Parkir Bandung' }}
        </h2>

        <div class="space-y-4">
            @forelse($locations as $loc)
                <div class="bg-white rounded-[2rem] p-5 flex gap-4 border border-slate-100 shadow-sm relative group active:scale-[0.98] transition-all">
                    <div class="w-20 h-20 bg-[#F1F3F5] rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-10 h-10 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Lokasi Bandung</p>
                        <h3 class="text-sm font-extrabold text-[#1A1A1A] leading-tight mt-0.5">{{ $loc->name }}</h3>
                        <p class="text-[10px] text-slate-400 font-medium mt-0.5 leading-snug">
                            {{ Str::limit($loc->address, 45) }}
                        </p>
                        <div class="mt-3 flex">
                            @if($loc->available_slots > 0)
                                <span class="bg-[#D1FADF] text-[#039855] text-[10px] font-black px-3 py-1 rounded-lg uppercase">
                                    {{ $loc->available_slots }} slot tersedia
                                </span>
                            @else
                                <span class="bg-red-100 text-red-600 text-[10px] font-black px-3 py-1 rounded-lg uppercase">Penuh</span>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Navigasi --}}
                    <button onclick="startNavigation('{{ $loc->latitude }}', '{{ $loc->longitude }}', '{{ $loc->id }}')"
                        class="absolute bottom-5 right-5 w-11 h-11 bg-[#2D7CF6] rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-100 transition-all hover:scale-110 active:scale-95">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-10 text-center border-2 border-dashed border-slate-200">
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Tidak ada lokasi ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- BOTTOM NAVIGATION --}}
    <div class="fixed bottom-0 w-full bg-white border-t border-slate-100 px-6 py-4 flex justify-between items-center shadow-[0_-10px_20px_rgba(0,0,0,0.02)] z-50">
        <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center gap-1.5">
            <div class="w-12 h-10 {{ request()->routeIs('user.dashboard') ? 'bg-[#2D7CF6] text-white shadow-lg shadow-blue-100' : 'bg-[#E9ECEF] text-slate-400' }} rounded-xl flex items-center justify-center transition-all">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" /></svg>
            </div>
            <span class="text-[10px] font-extrabold {{ request()->routeIs('user.dashboard') ? 'text-[#2D7CF6]' : 'text-slate-400' }} uppercase tracking-tighter">Home</span>
        </a>

        <a href="{{ route('user.history') }}" class="flex flex-col items-center gap-1.5">
            <div class="w-12 h-10 {{ request()->routeIs('user.history') ? 'bg-[#2D7CF6] text-white' : 'bg-[#E9ECEF] text-slate-400' }} rounded-xl flex items-center justify-center transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-[10px] font-extrabold {{ request()->routeIs('user.history') ? 'text-[#2D7CF6]' : 'text-slate-400' }} uppercase tracking-tighter">Riwayat</span>
        </a>

        <a href="{{ route('user.profile') }}" class="flex flex-col items-center gap-1.5">
            <div class="w-12 h-10 {{ request()->routeIs('user.profile') ? 'bg-[#2D7CF6] text-white' : 'bg-[#E9ECEF] text-slate-400' }} rounded-xl flex items-center justify-center transition-all overflow-hidden">
                @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" class="w-full h-full object-cover">
                @else
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                @endif
            </div>
            <span class="text-[10px] font-extrabold {{ request()->routeIs('user.profile') ? 'text-[#2D7CF6]' : 'text-slate-400' }} uppercase tracking-tighter">Profil</span>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="flex flex-col items-center gap-1.5">
            @csrf
            <button type="submit" class="w-12 h-10 bg-[#E9ECEF] rounded-xl flex items-center justify-center text-slate-400 hover:text-red-500 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-tighter">Logout</span>
        </form>
    </div>

    <script>
        // Fungsi Navigasi & Simpan Riwayat
        function startNavigation(lat, lng, locationId) {
            fetch("{{ route('user.history.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ parking_location_id: locationId })
            })
            .then(response => {
                const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
                window.open(url, '_blank');
            })
            .catch(err => {
                console.error("Gagal mencatat riwayat:", err);
                const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
                window.open(url, '_blank');
            });
        }

        // Fungsi Geolocation untuk filter terdekat
        function applyLocationFilter(event, category) {
            event.preventDefault();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    let url = `{{ route('user.dashboard') }}?category=${category}&lat=${lat}&lng=${lng}`;

                    const searchQuery = document.querySelector('input[name="search"]').value;
                    if(searchQuery) url += `&search=${searchQuery}`;

                    window.location.href = url;
                }, (error) => {
                    window.location.href = `{{ route('user.dashboard') }}?category=${category}`;
                });
            } else {
                window.location.href = `{{ route('user.dashboard') }}?category=${category}`;
            }
        }
    </script>
</body>
</html>
