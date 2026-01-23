<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-900 min-h-screen text-white flex flex-col">

    <nav class="p-6 flex justify-between items-center border-b border-slate-800">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center font-bold text-xl">P</div>
            <div>
                <h1 class="font-bold text-lg leading-none">ParkEase</h1>
                <p class="text-xs text-slate-400">Mode Petugas</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-400 text-sm font-bold hover:text-white transition-colors">Logout</button>
        </form>
    </nav>

    <main class="flex-1 p-6 flex flex-col justify-center max-w-md mx-auto w-full">

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 p-4 rounded-xl mb-6 text-center text-sm font-bold">
                {{ session('error') }}
            </div>
        @endif

        @if(isset($error))
            {{-- Tampilan jika Petugas belum di-assign --}}
            <div class="text-center py-10">
                <div class="bg-slate-800 p-8 rounded-3xl mb-4">
                    <svg class="w-16 h-16 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <h2 class="text-xl font-bold text-white mb-2">Akun Belum Aktif</h2>
                    <p class="text-slate-400 text-sm">{{ $error }}</p>
                </div>
            </div>
        @else
            {{-- Tampilan Normal --}}
            <div class="text-center mb-8">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">LOKASI BERTUGAS</p>
                <h2 class="text-2xl font-black text-white">{{ $location->name }}</h2>
                <span class="inline-block mt-2 px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $location->status == 'open' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                    Status: {{ $location->status }}
                </span>
            </div>

            <div class="bg-slate-800 rounded-[2.5rem] p-8 text-center shadow-2xl border border-slate-700 mb-8 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-slate-700">
                    <div class="h-full bg-blue-500 transition-all duration-500" style="width: {{ ($location->available_slots / $location->total_slots) * 100 }}%"></div>
                </div>

                <p class="text-slate-400 text-sm font-bold uppercase mb-4">Slot Tersedia</p>
                <div class="text-8xl font-black text-white tracking-tighter mb-2">
                    {{ $location->available_slots }}
                </div>
                <p class="text-slate-500 text-sm font-medium">dari {{ $location->total_slots }} total kapasitas</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- Tombol Masuk (Kurangi Slot) --}}
                <form action="{{ route('petugas.update-slot') }}" method="POST">
                    @csrf
                    <input type="hidden" name="location_id" value="{{ $location->id }}">
                    <input type="hidden" name="action" value="decrement">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white p-6 rounded-3xl transition-all active:scale-95 shadow-lg shadow-blue-900/30 group">
                        <div class="text-left">
                            <svg class="w-8 h-8 mb-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                            <span class="block text-xs font-bold opacity-70">KENDARAAN</span>
                            <span class="block text-2xl font-black">MASUK</span>
                        </div>
                    </button>
                </form>

                {{-- Tombol Keluar (Tambah Slot) --}}
                <form action="{{ route('petugas.update-slot') }}" method="POST">
                    @csrf
                    <input type="hidden" name="location_id" value="{{ $location->id }}">
                    <input type="hidden" name="action" value="increment">
                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-700 text-white p-6 rounded-3xl transition-all active:scale-95 border border-slate-700 group">
                        <div class="text-left">
                            <svg class="w-8 h-8 mb-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span class="block text-xs font-bold opacity-70">KENDARAAN</span>
                            <span class="block text-2xl font-black">KELUAR</span>
                        </div>
                    </button>
                </form>
            </div>
        @endif
    </main>
</body>
</html>
