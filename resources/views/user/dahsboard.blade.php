<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 pb-20">
    <div class="p-6 bg-white sticky top-0 shadow-sm z-10 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-extrabold text-slate-900">ParkEase</h1>
            <p class="text-xs text-slate-400 font-medium">Cari tempat parkirmu</p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-xs font-bold text-red-500 bg-red-50 px-4 py-2 rounded-xl">KELUAR</button>
        </form>
    </div>

    <div class="p-6">
        <h2 class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Lokasi Parkir Tersedia</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($locations as $loc)
            <div class="bg-white rounded-3xl p-5 shadow-sm border border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-slate-800">{{ $loc->name }}</h3>
                    <p class="text-[10px] text-slate-400 mb-3">{{ $loc->address }}</p>
                    <span class="px-3 py-1 rounded-lg text-[10px] font-black {{ $loc->available_slots > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        {{ $loc->available_slots }} SLOT TERSEDIA
                    </span>
                </div>
                <div class="bg-blue-600 p-3 rounded-2xl text-white shadow-lg shadow-blue-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="3"/></svg>
                </div>
            </div>
            @empty
            <p class="text-slate-400 text-sm">Belum ada data lokasi parkir.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
