<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white min-h-screen flex flex-col items-center justify-center p-6">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-black text-gray-800">Daftar Akun</h1>
        <p class="text-gray-400 text-sm">Cari parkir lebih mudah dengan ParkEase</p>
    </div>

    <form action="{{ route('register.post') }}" method="POST" class="w-full max-w-sm space-y-4">
        @csrf
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
            <input type="text" name="name" required
                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 mt-1 focus:border-blue-500 outline-none transition-all">
        </div>
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
            <input type="email" name="email" required
                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 mt-1 focus:border-blue-500 outline-none transition-all">
        </div>
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kata Sandi</label>
            <input type="password" name="password" required
                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 mt-1 focus:border-blue-500 outline-none transition-all">
        </div>
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Kata
                Sandi</label>
            <input type="password" name="password_confirmation" required
                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 mt-1 focus:border-blue-500 outline-none transition-all">
        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white font-bold py-4 rounded-2xl shadow-xl shadow-blue-100 mt-4 uppercase tracking-widest text-sm">
            Daftar Sekarang
        </button>

        <p class="text-center text-gray-400 text-xs mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 font-bold">Masuk</a>
        </p>
    </form>
</body>

</html>
