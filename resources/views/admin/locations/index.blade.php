@extends('layouts.admin')

@section('title', 'Kelola Lokasi')

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
    <div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Kelola Lokasi Parkir</h2>
        <p class="text-slate-400 font-medium mt-1">Tambah atau edit titik lokasi parkir dalam sistem.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm h-fit">
        <h3 class="font-black text-slate-900 text-lg mb-6">Tambah Lokasi Baru</h3>

        <form action="{{ route('admin.locations.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Lokasi</label>
                <input type="text" name="name" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Contoh: Parkir Gedung Sate">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Alamat Lengkap</label>
                <textarea name="address" required rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500" placeholder="Jalan..."></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Wilayah</label>
                    <select name="region" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold">
                        <option value="Bandung Tengah">Bandung Tengah</option>
                        <option value="Bandung Utara">Bandung Utara</option>
                        <option value="Bandung Timur">Bandung Timur</option>
                        <option value="Bandung Selatan">Bandung Selatan</option>
                        <option value="Bandung Barat">Bandung Barat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Total Slot</label>
                    <input type="number" name="total_slots" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Latitude</label>
                    <input type="text" name="latitude" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold" placeholder="-6.9175">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Longitude</label>
                    <input type="text" name="longitude" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold" placeholder="107.6191">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Harga / Jam (Rp)</label>
                <input type="number" name="price_per_hour" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold" placeholder="2000">
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-slate-800 transition-all mt-4">
                + Simpan Lokasi
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Nama & Wilayah</th>
                        <th class="px-6 py-4">Koordinat</th>
                        <th class="px-6 py-4 text-center">Kapasitas</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($locations as $loc)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $loc->name }}</div>
                            <div class="text-xs text-slate-400 font-medium">{{ $loc->region }}</div>
                        </td>
                        <td class="px-6 py-4 text-xs font-mono text-slate-500">
                            {{ $loc->latitude }}, <br> {{ $loc->longitude }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-blue-100 text-blue-700 font-bold px-3 py-1 rounded-lg text-xs">{{ $loc->total_slots }} Slot</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.locations.destroy', $loc->id) }}" method="POST" onsubmit="return confirm('Hapus lokasi ini? Data history juga akan hilang.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 font-bold text-xs bg-red-50 hover:bg-red-100 px-3 py-2 rounded-lg transition-all">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada data lokasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
