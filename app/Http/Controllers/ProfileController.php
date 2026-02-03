<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8F9FA] min-h-screen pb-28">

    <div class="bg-white pt-8 pb-6 px-6 border-b border-slate-50 sticky top-0 z-50">
        <h1 class="text-2xl font-black text-[#1A1A1A]">Profil Saya</h1>
    </div>

    <div class="flex flex-col items-center mt-8">
        <div class="w-24 h-24 rounded-full bg-blue-50 border-4 border-white shadow-xl shadow-blue-100 overflow-hidden relative">
            @if(Auth::user()->avatar)
            <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="Foto Profil" class="w-full h-full object-cover">
            @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" alt="Foto Profil" class="w-full h-full object-cover">
            @endif
        </div>
        <h2 class="mt-4 text-xl font-extrabold text-[#1A1A1A]">{{ Auth::user()->name }}</h2>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Pengendara' }}</p>
    </div>

    <div class="px-6 space-y-3 mt-8">
        <a href="{{ route('profile.edit') }}" class="flex items-center justify-between bg-white p-5 rounded-3xl border border-slate-50 shadow-sm active:scale-[0.98] transition-all">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <span class="text-sm font-bold text-slate-700">Edit Profile (Nama & Email)</span>
            </div>
            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>

        <a href="{{ route('profile.password') }}" class="flex items-center justify-between bg-white p-5 rounded-3xl border border-slate-50 shadow-sm active:scale-[0.98] transition-all">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-orange-50 text-orange-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <span class="text-sm font-bold text-slate-700">Ganti Password</span>
            </div>
            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-between bg-white p-5 rounded-3xl border border-slate-50 shadow-sm active:scale-[0.98] transition-all group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700 group-hover:text-red-600 transition-colors">Keluar Aplikasi</span>
                </div>
            </button>
        </form>
    </div>

    <div class="fixed bottom-0 w-full bg-white border-t border-slate-100 px-6 py-4 flex justify-between items-center shadow-[0_-10px_20px_rgba(0,0,0,0.02)] z-50">
        <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center gap-1.5 group">
            <div class="w-12 h-10 bg-[#E9ECEF] text-slate-400 group-hover:bg-blue-50 rounded-xl flex items-center justify-center transition-all duration-300">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
            </div>
            <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-tighter">Home</span>
        </a>
        <a href="{{ route('user.history') }}" class="flex flex-col items-center gap-1.5
