@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total Lokasi</p>
        <h4 class="text-3xl font-black text-gray-800">12</h4>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Slot Tersedia</p>
        <h4 class="text-3xl font-black text-green-500">452</h4>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Petugas Aktif</p>
        <h4 class="text-3xl font-black text-blue-500">24</h4>
    </div>
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Total User</p>
        <h4 class="text-3xl font-black text-purple-500">1.2K</h4>
    </div>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-white">
        <div>
            <h3 class="font-black text-gray-800 text-xl">Data Lokasi Parkir Real-Time</h3>
            <p class="text-xs text-gray-400 mt-1">Daftar lokasi yang terintegrasi dengan Google Maps API</p>
        </div>
        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-sm font-bold shadow-lg shadow-blue-100 transition-all">
            + Tambah Lokasi Baru
        </button>
    </div>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50/50">
                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lokasi</th>
                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Wilayah</th>
                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Kapasitas</th>
                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-8 py-6">
                    <p class="font-bold text-gray-800 text-sm">Mall BEC Bandung</p>
                    <p class="text-[10px] text-gray-400">Jl. Purnawarman No. 13-15</p>
                </td>
                <td class="px-8 py-6 text-sm text-gray-500 font-medium">Bandung Tengah</td>
                <td class="px-8 py-6 text-center">
                    <span class="text-sm font-bold text-gray-700">15</span>
                    <span class="text-[10px] text-gray-400">/ 100</span>
                </td>
                <td class="px-8 py-6">
                    <span class="bg-green-100 text-green-600 text-[10px] px-3 py-1.5 rounded-lg font-black uppercase">Normal</span>
                </td>
                <td class="px-8 py-6 text-right space-x-2">
                    <button class="text-blue-500 hover:text-blue-700 font-bold text-[10px] uppercase tracking-wider">Edit</button>
                    <button class="text-red-400 hover:text-red-600 font-bold text-[10px] uppercase tracking-wider">Hapus</button>
                </td>
            </tr>
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-8 py-6">
                    <p class="font-bold text-gray-800 text-sm">Pasar Baru Heritage</p>
                    <p class="text-[10px] text-gray-400">Jl. Otto Iskandar Dinata</p>
                </td>
                <td class="px-8 py-6 text-sm text-gray-500 font-medium">Bandung Tengah</td>
                <td class="px-8 py-6 text-center">
                    <span class="text-sm font-bold text-gray-700 text-red-400">0</span>
                    <span class="text-[10px] text-gray-400">/ 80</span>
                </td>
                <td class="px-8 py-6">
                    <span class="bg-red-100 text-red-500 text-[10px] px-3 py-1.5 rounded-lg font-black uppercase tracking-tight">Penuh</span>
                </td>
                <td class="px-8 py-6 text-right space-x-2">
                    <button class="text-blue-500 hover:text-blue-700 font-bold text-[10px] uppercase tracking-wider">Edit</button>
                    <button class="text-red-400 hover:text-red-600 font-bold text-[10px] uppercase tracking-wider">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
