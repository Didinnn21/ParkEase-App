<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - ParkEase Bandung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen pb-32">

    <div class="px-6 pt-12 pb-6">
        <h1 class="text-2xl font-extrabold text-[#1A1A1A]">Profile Saya</h1>
    </div>

    <div class="flex flex-col items-center mb-10">
        <div class="relative">
            <div class="w-28 h-28 bg-slate-200 rounded-full flex items-center justify-center text-slate-400 text-3xl font-bold border-4 border-white shadow-sm overflow-hidden">
                <span class="text-4xl">??</span>
            </div>
            <button class="absolute bottom-1 right-1 w-8 h-8 bg-[#2D7CF6] rounded-full border-2 border-white flex items-center justify-center text-white shadow-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </button>
        </div>
        <h2 class="mt-4 text-xl font-extrabold text-[#1A1A1A]">{{ Auth::user()->name }}</h2>
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">PENGENDARA</p>
    </div>

    <div class="px-6 space-y-3">
        <a href="{{ route('user.profile.edit') }}" class="flex items-center justify-between bg-white p-5 rounded-3xl border border-slate-50 shadow-sm active:scale-[0.98] transition-all">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <span class="text-sm font-bold text-slate-700">Edit Profile (Nama & Email)</span>
            </div>
            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>

        <a href="{{ route('user.profile.password') }}" class="flex items-center justify-between bg-white p-5 rounded-3xl border border-slate-50 shadow-sm active:scale-[0.98] transition-all">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <span class="text-sm font-bold text-slate-700">Keamanan (Ganti Password)</span>
            </div>
            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>

        <a href="{{ route('user.history') }}" class="flex items-center justify-between bg-white p-5 rounded-3xl border border-slate-50 shadow-sm active:scale-[0.98] transition-all">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-sm font-bold text-slate-700">Riwayat Parkir</span>
            </div>
            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>

        <a href="#" class="flex items-center justify-between bg-white p-5 rounded-3xl border border-slate-50 shadow-sm active:scale-[0.98] transition-all">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-sm font-bold text-slate-700">Pusat Bantuan</span>
            </div>
            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>

    <div class="px-6 mt-10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full py-4 border-2 border-red-100 text-red-500 font-extrabold rounded-2xl hover:bg-red-50 transition-all active:scale-[0.98]">
                Keluar Akun
            </button>
        </form>
    </div>

    <div class="fixed bottom-0 w-full bg-white border-t border-slate-100 px-6 py-4 flex justify-between items-center shadow-[0_-10px_20px_rgba(0,0,0,0.02)] z-50">
        <a href="{{ route('user.dashboard') }}" class="flex flex-col items-center gap-1">
            <div class="w-12 h-10 bg-[#E9ECEF] text-slate-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            </div>
            <span class="text-[9px] font-black text-slate-400 uppercase">Home</span>
        </a>
        <a href="{{ route('user.history') }}" class="flex flex-col items-center gap-1">
            <div class="w-12 h-10 bg-[#E9ECEF] text-slate-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="text-[9px] font-black text-slate-400 uppercase">Riwayat</span>
        </a>
        <a href="{{ route('user.notifications') }}" class="flex flex-col items-center gap-1">
            <div class="w-12 h-10 bg-[#E9ECEF] text-slate-400 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
            <span class="text-[9px] font-black text-slate-400 uppercase">Notifikasi</span>
        </a>
        <a href="{{ route('user.profile') }}" class="flex flex-col items-center gap-1">
            <div class="w-12 h-10 bg-[#2D7CF6] text-white shadow-lg shadow-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <span class="text-[9px] font-black text-[#2D7CF6] uppercase">Profil</span>
        </a>
    </div>

</body>
</html>
