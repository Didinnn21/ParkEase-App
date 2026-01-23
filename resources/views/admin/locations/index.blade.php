@extends('layouts.admin')

@section('title', 'Kelola Lokasi')

@section('content')
{{-- Muat CSS Leaflet dari CDN --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

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

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Pilih Titik Lokasi (Peta)</label>
                {{-- z-0 penting supaya peta tidak menutupi dropdown/modal --}}
                <div id="map" class="w-full h-64 rounded-xl border border-slate-200 overflow-hidden shadow-inner z-0"></div>
                <p class="text-[10px] text-slate-400 mt-1 italic">*Klik peta atau geser pin biru untuk set koordinat.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Latitude</label>
                    <input type="text" id="lat_input" name="latitude" required readonly class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-500 cursor-not-allowed" placeholder="-6.9175">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Longitude</label>
                    <input type="text" id="lng_input" name="longitude" required readonly class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-500 cursor-not-allowed" placeholder="107.6191">
                </div>
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

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Harga / Jam (Rp)</label>
                <input type="number" name="price_per_hour" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold" placeholder="2000">
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-slate-800 transition-all mt-4">
                + Simpan Lokasi
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden h-fit">
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

{{-- Muat JS Leaflet dari CDN --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Koordinat Default: Alun-alun Bandung
        const defaultLat = -6.921477;
        const defaultLng = 107.611654;

        // Inisialisasi Peta
        var map = L.map('map').setView([defaultLat, defaultLng], 15);

        // Tambahkan Tile Layer (Peta Jalan OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Buat Marker yang boleh digeser (Draggable)
        var marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        // Fungsi update input form
        function updateInputs(lat, lng) {
            document.getElementById('lat_input').value = lat.toFixed(7);
            document.getElementById('lng_input').value = lng.toFixed(7);
        }

        // Set nilai awal
        updateInputs(defaultLat, defaultLng);

        // Event: Saat marker selesai digeser
        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            updateInputs(position.lat, position.lng);
            map.panTo(position);
        });

        // Event: Saat peta diklik (Pindahkan marker ke situ)
        map.on('click', function(e) {
            var position = e.latlng;
            marker.setLatLng(position);
            updateInputs(position.lat, position.lng);
            map.panTo(position);
        });

        // Fix isu peta tidak render penuh jika dalam hidden container/modal
        setTimeout(function() { map.invalidateSize(); }, 100);
    });
</script>
@endsection
