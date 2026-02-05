<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#F8F9FA] min-h-screen flex items-center justify-center p-6">

    <div class="bg-white max-w-lg w-full rounded-[2rem] border border-slate-100 shadow-xl overflow-hidden relative">

        <div class="h-32 bg-blue-600 relative">
            <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('petugas.dashboard') }}" class="absolute top-6 left-6 text-white/80 hover:text-white flex items-center gap-2 text-xs font-bold uppercase tracking-wider">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="px-8 pb-8">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="relative">
                @csrf
                @method('PUT')

                <div class="relative -mt-16 mb-6 text-center">
                    <div class="relative inline-block">
                        <img src="{{ $user->photo_url }}" class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover bg-slate-100">

                        <label for="photo" class="absolute bottom-0 right-0 bg-slate-900 text-white p-2.5 rounded-full hover:bg-slate-700 cursor-pointer shadow-lg transition-transform active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </label>
                        {{-- Ganti name="photo" menjadi name="avatar" --}}
<input type="file" name="photo" id="photo" class="hidden" onchange="this.form.submit()">                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-50 text-green-700 px-4 py-2 rounded-xl text-sm font-bold text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-900 focus:outline-none focus:border-blue-500 transition-colors">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Alamat Email</label>
                        <input type="email" value="{{ $user->email }}" readonly class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-500 cursor-not-allowed">
                    </div>

                    @if($user->role == 'petugas' && $user->location)
                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex items-start gap-3">
                        <div class="text-blue-500 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-blue-400 uppercase tracking-wider">Lokasi Bertugas</p>
                            <p class="font-extrabold text-blue-900 text-lg leading-tight">{{ $user->location->name }}</p>
                            <p class="text-xs font-medium text-blue-600/70">{{ $user->location->address }}</p>
                        </div>
                    </div>
                    @endif

                    <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold text-sm hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
