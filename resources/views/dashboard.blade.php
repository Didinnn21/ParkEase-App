<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkEase - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen pb-24">

    <div class="p-4 bg-white sticky top-0 z-10 shadow-sm">
        <div class="relative mb-4">
            <input type="text" placeholder="cari lokasi parkir..."
                class="w-full bg-gray-200 border-none rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-blue-400 outline-none">
        </div>

        <div class="flex space-x-2 overflow-x-auto no-scrollbar pb-2">
            <button
                class="px-4 py-1.5 bg-blue-500 text-white rounded-lg text-xs font-semibold whitespace-nowrap">Terdekat</button>
            <button
                class="px-4 py-1.5 bg-gray-300 text-gray-700 rounded-lg text-xs font-semibold whitespace-nowrap">Bandung
                Tengah</button>
            <button
                class="px-4 py-1.5 bg-gray-300 text-gray-700 rounded-lg text-xs font-semibold whitespace-nowrap">Mall</button>
            <button
                class="px-4 py-1.5 bg-gray-300 text-gray-700 rounded-lg text-xs font-semibold whitespace-nowrap">Pasar
                Kal...</button>
        </div>
    </div>

    <div class="p-4">
        <h2 class="text-sm font-bold text-gray-800 mb-4 uppercase tracking-tight">Lokasi Parkir di Sekitar Anda</h2>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 mb-4 flex justify-between items-center">
            <div class="flex-1">
                <span class="text-green-600 text-[10px] font-bold">~3,7 km</span>
                <h3 class="font-bold text-gray-900 leading-tight">Mall BEC Bandung</h3>
                <p class="text-gray-500 text-[10px] mb-2 leading-tight">Jl. Purnawarman No. 13-15, Babakan Ciamis</p>
                <span class="bg-green-100 text-green-600 text-[10px] px-3 py-1 rounded-full font-bold">15 slot
                    tersedia</span>
            </div>
            <button class="bg-red-400 p-2 rounded-lg text-white shadow-sm ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        <div
            class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 mb-4 flex justify-between items-center opacity-90">
            <div class="flex-1">
                <span class="text-green-600 text-[10px] font-bold">~5,8 km</span>
                <h3 class="font-bold text-gray-900 leading-tight">Pasar Baru Heritage</h3>
                <p class="text-gray-500 text-[10px] mb-2 leading-tight">Jl. Otto Iskandar Dinata No. 70</p>
                <span
                    class="bg-red-100 text-red-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase">PENUH</span>
            </div>
            <button class="bg-red-400 p-2 rounded-lg text-white shadow-sm ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div>

    <div id="gpsModal" class="fixed inset-0 z-50 flex items-center justify-center p-6 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-8 w-full max-w-sm text-center shadow-2xl">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Aktifkan GPS</h3>
            <p class="text-gray-500 text-xs mb-8">Mohon Aktifkan GPS untuk mencari lokasi parkir di sekitar Anda</p>
            <button onclick="closeModal()"
                class="w-full bg-blue-500 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-200">
                AKTIFKAN
            </button>
        </div>
    </div>

    <nav class="fixed bottom-0 w-full bg-white border-t flex justify-around p-3 pb-6">
        <a href="#" class="text-center group">
            <div class="w-10 h-10 bg-blue-500 rounded-xl mb-1 flex items-center justify-center">
                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
                </svg>
            </div>
            <span class="text-[10px] font-bold text-blue-500">HOME</span>
        </a>
        <a href="#" class="text-center group">
            <div class="w-10 h-10 bg-gray-300 rounded-xl mb-1 flex items-center justify-center"></div>
            <span class="text-[10px] font-bold text-gray-500">RIWAYAT</span>
        </a>
        <a href="#" class="text-center group">
            <div class="w-10 h-10 bg-gray-300 rounded-xl mb-1 flex items-center justify-center"></div>
            <span class="text-[10px] font-bold text-gray-500 leading-none text-center">NOTIFIKASI</span>
        </a>
        <a href="#" class="text-center group">
            <div class="w-10 h-10 bg-gray-300 rounded-xl mb-1 flex items-center justify-center"></div>
            <span class="text-[10px] font-bold text-gray-500">PROFIL</span>
        </a>
    </nav>

    <script>
        function closeModal() {
            document.getElementById('gpsModal').classList.add('hidden');
        }
    </script>
</body>

</html>
