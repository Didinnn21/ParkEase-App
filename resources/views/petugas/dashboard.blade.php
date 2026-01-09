<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white min-h-screen flex flex-col items-center justify-center p-6">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-black text-blue-400">PETUGAS PARKEASE</h1>
        <p class="text-slate-400 text-sm mt-1">{{ $location->name ?? 'Lokasi Tidak Ditemukan' }}</p>
    </div>

    <div class="bg-slate-800 rounded-[3rem] p-10 w-full max-w-sm text-center shadow-2xl border border-slate-700">
        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Slot Tersedia</p>
        <div class="text-8xl font-black mb-10">{{ $location->available_slots ?? 0 }}</div>

        <form action="{{ route('petugas.update-slot') }}" method="POST" class="grid grid-cols-2 gap-4">
            @csrf
            <input type="hidden" name="location_id" value="{{ $location->id ?? '' }}">

            <button name="action" value="decrement" class="bg-red-500/20 border-2 border-red-500 text-red-500 font-black py-8 rounded-3xl text-4xl active:scale-90 transition">-</button>
            <button name="action" value="increment" class="bg-green-500/20 border-2 border-green-500 text-green-500 font-black py-8 rounded-3xl text-4xl active:scale-90 transition">+</button>
        </form>

        <div class="mt-8 pt-8 border-t border-slate-700">
            <p class="text-[10px] text-slate-500">Kapasitas Maksimal: {{ $location->total_slots ?? 0 }}</p>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf</form>

    <button type="button"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="text-red-500 font-bold underline">KELUAR</button>
</body>
</html>
