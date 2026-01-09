<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-900 text-white min-h-screen flex flex-col items-center p-6">

    <div class="w-full max-w-md flex justify-between items-center mb-10 mt-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <h1 class="text-xl font-black tracking-tight text-white uppercase italic">ParkEase</h1>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-[10px] font-black bg-red-500/10 text-red-500 px-4 py-2 rounded-xl border border-red-500/20 uppercase tracking-widest">Keluar</button>
        </form>
    </div>

    <div class="w-full max-w-md bg-slate-800 rounded-[3rem] p-10 shadow-2xl border border-slate-700 text-center relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl"></div>

        <p class="text-blue-400 text-[10px] font-black uppercase tracking-[0.3em] mb-2">Petugas Lapangan</p>
        <h2 class="text-2xl font-extrabold mb-10 leading-tight">{{ $location->name ?? 'Lokasi Belum Dipilih' }}</h2>

        <div class="space-y-1 mb-10">
            <p class="text-slate-400 text-xs font-medium">Slot Tersedia Saat Ini</p>
            <div class="text-[7rem] font-black leading-none text-white tracking-tighter">
                {{ $location->available_slots ?? 0 }}
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">Kapasitas: {{ $location->total_slots ?? 0 }}</p>
        </div>

        <form action="{{ route('petugas.update-slot') }}" method="POST" class="grid grid-cols-2 gap-5">
            @csrf
            <input type="hidden" name="location_id" value="{{ $location->id ?? '' }}">

            <button name="action" value="decrement" class="bg-red-500/10 border-2 border-red-500/50 text-red-500 font-black py-8 rounded-[2rem] text-4xl active:scale-90 transition-all shadow-lg shadow-red-500/10">
                -
            </button>
            <button name="action" value="increment" class="bg-green-500/10 border-2 border-green-500/50 text-green-500 font-black py-8 rounded-[2rem] text-4xl active:scale-90 transition-all shadow-lg shadow-green-500/10">
                +
            </button>
        </form>

        @if(session('status'))
            <div class="mt-6 text-green-400 text-[10px] font-bold uppercase tracking-widest animate-bounce">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="mt-10 text-center">
        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">Update Terakhir</p>
        <p class="text-slate-400 text-xs font-medium">{{ date('H:i') }} WIB, Hari Ini</p>
    </div>

</body>
</html>
