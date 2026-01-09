<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Slot - Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-900 text-white min-h-screen flex flex-col items-center justify-center p-6">
    <div class="text-center mb-10">
        <p class="text-blue-400 text-xs font-bold uppercase tracking-widest">Petugas Lapangan</p>
        <h1 class="text-2xl font-black mt-1">{{ $location->name ?? 'Lokasi Belum Diset' }}</h1>
    </div>

    <div class="bg-slate-800 rounded-[3rem] p-10 w-full max-w-sm text-center shadow-2xl border border-slate-700">
        <p class="text-slate-400 text-sm mb-2">Slot Tersedia Saat Ini</p>
        <div class="text-7xl font-black text-white mb-8">{{ $location->available_slots ?? 0 }}</div>

        <div class="grid grid-cols-2 gap-4">
            <button
                class="bg-red-500/10 border border-red-500/50 text-red-500 font-bold py-6 rounded-3xl text-2xl active:scale-95 transition">-
                1</button>
            <button
                class="bg-green-500/10 border border-green-500/50 text-green-500 font-bold py-6 rounded-3xl text-2xl active:scale-95 transition">+
                1</button>
        </div>

        <button
            class="w-full mt-6 py-4 bg-slate-700 rounded-2xl font-bold text-xs uppercase tracking-widest text-slate-300">Reset
            Slot</button>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="mt-12">
        @csrf
        <button type="submit" class="text-slate-500 text-sm font-bold underline">Keluar Sistem</button>
    </form>
</body>

</html>
