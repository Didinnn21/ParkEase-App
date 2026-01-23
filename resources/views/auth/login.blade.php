<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - ParkEase Bandung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4">

    <div
        class="w-full max-w-[400px] bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 p-8 md:p-10 border border-slate-100">
        <div class="text-center mb-10">
            <div
                class="w-24 h-24 bg-white rounded-[2rem] mx-auto flex items-center justify-center shadow-xl shadow-slate-100 mb-6 transform -rotate-6 border border-slate-50 overflow-hidden p-2">
                <img src="{{ asset('assets/img/Logo_ParkEasy.jpeg') }}" alt="Logo ParkEase"
                    class="w-full h-full object-contain">
            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">ParkEase</h1>
            <p class="text-slate-400 text-sm mt-2 font-medium">Masuk untuk akses parkir Bandung</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf

            @if($errors->any())
                <div
                    class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl text-xs font-bold animate-pulse">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="space-y-2">
                <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest ml-1">Alamat
                    Email</label>
                <div class="relative">
                    <input type="email" name="email" placeholder="nama@email.com" required value="{{ old('email') }}"
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all duration-300 text-sm font-semibold">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest ml-1">Kata
                    Sandi</label>
                <input type="password" name="password" placeholder="••••••••" required
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all duration-300 text-sm font-semibold">
            </div>

            <button type="submit"
                class="w-full bg-[#2D7CF6] hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-200 transition-all active:scale-[0.97] uppercase tracking-widest text-xs mt-4">
                Masuk Sekarang
            </button>

            <div class="pt-6 text-center">
                <p class="text-slate-400 text-xs font-medium">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-[#2D7CF6] font-bold ml-1 hover:underline">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>

</body>

</html>
