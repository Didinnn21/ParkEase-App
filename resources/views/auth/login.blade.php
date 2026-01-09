<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - ParkEase</title>
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
                class="w-20 h-20 bg-blue-600 rounded-3xl mx-auto flex items-center justify-center shadow-xl shadow-blue-200 mb-6 transform -rotate-6">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">ParkEase</h1>
            <p class="text-slate-400 text-sm mt-2 font-medium">Selamat datang kembali!</p>
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
                <input type="email" name="email" placeholder="nama@email.com" required value="{{ old('email') }}"
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all duration-300 text-sm font-semibold">
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest ml-1">Kata
                    Sandi</label>
                <input type="password" name="password" placeholder="••••••••" required
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all duration-300 text-sm font-semibold">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-200 transition-all active:scale-[0.97] uppercase tracking-widest text-xs mt-4">
                Masuk Sekarang
            </button>

            <div class="pt-6 text-center">
                <p class="text-center text-slate-400 text-xs mt-8 font-medium">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 font-bold ml-1 hover:underline">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </form>
    </div>

</body>

</html>
