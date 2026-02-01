<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Lokasi - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">
</head>

<body class="bg-slate-900 text-white min-h-screen p-6">
    <div class="max-w-md mx-auto">
        <div class="flex items-center gap-3 mb-10">
            <img src="{{ asset('assets/img/Logo_ParkEasy.jpeg') }}" class="w-10 h-10 rounded-xl object-cover">
            <h1 class="text-xl font-bold">Pilih Titik Tugas</h1>
        </div>

        <div class="space-y-4">
            @foreach($locations as $loc)
                <form action="{{ route('petugas.set-location') }}" method="POST">
                    @csrf
                    <input type="hidden" name="location_id" value="{{ $loc->id }}">
                    <button type="submit"
                        class="w-full bg-slate-800 p-5 rounded-[2rem] text-left border border-slate-700 hover:border-blue-500 transition-all group">
                        <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest">Titik Lokasi</span>
                        <h3 class="text-lg font-bold group-hover:text-blue-400">{{ $loc->name }}</h3>
                        <p class="text-xs text-slate-500">{{ $loc->address }}</p>
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</body>

</html>