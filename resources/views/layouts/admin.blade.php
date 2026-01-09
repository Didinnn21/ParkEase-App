<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex overflow-hidden h-screen">

    <aside class="w-72 bg-[#1E293B] text-white flex flex-col shadow-xl">
        <div class="p-8">
            <h1 class="text-2xl font-black text-blue-400 tracking-tight">ParkEase</h1>
            <p class="text-[10px] text-slate-400 font-bold tracking-widest uppercase mt-1">Sistem Manajemen Parkir</p>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="#" class="flex items-center space-x-3 px-4 py-3 bg-blue-600 rounded-xl font-semibold transition">
                <span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl transition">
                <span>Data Lokasi Parkir</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl transition">
                <span>Manajemen Akun</span>
            </a>
            <a href="#" class="flex items-center space-x-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl transition">
                <span>Laporan Historis</span>
            </a>
        </nav>

        <div class="p-6 border-t border-slate-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center font-bold">A</div>
                <div>
                    <p class="text-sm font-bold">Admin Utama</p>
                    <p class="text-[10px] text-slate-400">admin@parkease.com</p>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-10 sticky top-0 z-10">
            <h2 class="text-xl font-bold text-gray-800">Ringkasan Statistik</h2>
            <div class="flex items-center space-x-4">
                <span class="text-xs font-bold text-gray-400 px-3 py-1 bg-gray-100 rounded-full uppercase">Bandung, Jawa Barat</span>
            </div>
        </header>

        <div class="p-10">
            @yield('content')
        </div>
    </main>
</body>
</html>
