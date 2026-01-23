<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - ParkEase Bandung</title>
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
        class="w-full max-w-[450px] bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 p-8 md:p-10 border border-slate-100">

        <div class="mb-8 text-center">
            <div
                class="w-24 h-24 bg-white rounded-[2rem] mx-auto flex items-center justify-center shadow-xl shadow-slate-100 mb-6 transform -rotate-6 border border-slate-50 overflow-hidden p-2">
                <img src="{{ asset('assets/img/Logo_ParkEasy.jpeg') }}" alt="Logo ParkEase"
                    class="w-full h-full object-contain">
            </div>

            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Buat Akun</h1>
            <p class="text-slate-400 text-sm mt-2 font-medium">Mulai pengalaman parkir cerdas di Bandung</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
            @csrf

            <div class="space-y-1.5">
                <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest ml-1">Nama
                    Lengkap</label>
                <input type="text" name="name" placeholder="Masukkan nama lengkap" required value="{{ old('name') }}"
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all duration-300 text-sm font-semibold">
                @error('name') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest ml-1">Alamat
                    Email</label>
                <input type="email" name="email" placeholder="nama@email.com" required value="{{ old('email') }}"
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all duration-300 text-sm font-semibold">
                @error('email') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label
                        class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest ml-1">Sandi</label>
                    <input type="password" name="password" placeholder="••••••••" required
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all duration-300 text-sm font-semibold">
                </div>
                <div class="space-y-1.5">
                    <label
                        class="text-[11px] font-extrabold text-slate-500 uppercase tracking-widest ml-1">Konfirmasi</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••" required
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all duration-300 text-sm font-semibold">
                </div>
            </div>
            @error('password') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror

            <button type="submit"
                class="w-full bg-[#2D7CF6] hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-lg shadow-blue-200 transition-all active:scale-[0.97] uppercase tracking-widest text-xs mt-4">
                Daftar Sekarang
            </button>

            <div class="pt-4 text-center">
                <p class="text-slate-400 text-xs font-medium">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-[#2D7CF6] font-bold ml-1 hover:underline">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </div>

</body>

</html>
