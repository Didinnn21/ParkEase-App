<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white min-h-screen flex flex-col items-center justify-center p-6">

    <div class="mb-10 text-center">
        <div
            class="w-20 h-20 bg-blue-500 rounded-3xl mx-auto flex items-center justify-center shadow-xl shadow-blue-100 mb-4">
            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z" />
            </svg>
        </div>
        <h1 class="text-3xl font-black text-gray-800 tracking-tight">ParkEase</h1>
        <p class="text-gray-400 text-sm mt-1">Masuk untuk memantau parkir real-time</p>
    </div>

    <form class="w-full max-w-sm space-y-5">
        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
            <input type="email" placeholder="contoh@email.com"
                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 mt-1 focus:border-blue-500 focus:bg-white outline-none transition-all text-sm">
        </div>

        <div>
            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Kata Sandi</label>
            <input type="password" placeholder="••••••••"
                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 mt-1 focus:border-blue-500 focus:bg-white outline-none transition-all text-sm">
        </div>

        <div class="flex justify-end">
            <a href="#" class="text-xs font-bold text-blue-500 hover:text-blue-700">Lupa Kata Sandi?</a>
        </div>

        <button type="button"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-95 uppercase tracking-widest text-sm">
            Masuk
        </button>

        <p class="text-center text-gray-400 text-xs mt-8">
            Belum punya akun? <a href="#" class="text-blue-500 font-bold">Daftar Sekarang</a>
        </p>
    </form>

</body>

</html>
