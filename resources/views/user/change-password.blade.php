<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-white min-h-screen">

    <div class="px-6 pt-12 pb-6 flex items-center gap-4 border-b border-slate-50">
        <a href="{{ route('user.profile') }}"
            class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-xl font-extrabold text-[#1A1A1A]">Ganti Password</h1>
    </div>

    <div class="px-6 mt-10">
        <p class="text-xs text-slate-400 font-medium mb-8 leading-relaxed">
            Demi keamanan akun ParkEase Anda, jangan beritahukan password Anda kepada orang lain.
        </p>

        <form action="{{ route('user.profile.password.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Password
                    Sekarang</label>
                <input type="password" name="current_password" placeholder="••••••" required
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all text-sm font-bold">
                @error('current_password') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">! {{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Password
                    Baru</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" required
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all text-sm font-bold">
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Konfirmasi Password
                    Baru</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru" required
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all text-sm font-bold">
                @error('password') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">! {{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-[#2D7CF6] text-white font-extrabold py-5 rounded-[2rem] shadow-lg shadow-blue-100 transition-all active:scale-[0.98] uppercase tracking-widest text-xs mt-10">
                Simpan Perubahan
            </button>
        </form>
    </div>

</body>

</html>
