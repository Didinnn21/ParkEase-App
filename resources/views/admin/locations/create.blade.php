@extends('layouts.admin')

@section('title', 'Tambah Lokasi')

@section('content')
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-slate-800">Tambah Lokasi Baru</h2>
            <a href="{{ route('admin.locations.index') }}"
                class="text-sm text-slate-500 hover:text-blue-600 font-medium transition-colors">
                &larr; Kembali
            </a>
        </div>

        {{-- Alert untuk Error Database / Exception --}}
        @if (session('error'))
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        @endif

        {{-- Alert untuk Validasi Form --}}
        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
                <div class="font-bold mb-1">Cek kembali inputan Anda:</div>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.locations.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lokasi <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Paris Van Java" required
                    class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-1">Kategori <span
                        class="text-red-500">*</span></label>
                <select name="category" required
                    class="w-full border border-slate-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all cursor-pointer">
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <option value="umum" {{ old('category') == 'umum' ? 'selected' : '' }}>Umum</option>
                    <option value="mall" {{ old('category') == 'mall' ? 'selected' : '' }}>Mall / Pusat Perbelanjaan</option>
                    <option value="pasar" {{ old('category') == 'pasar' ? 'selected' : '' }}>Pasar Tradisional</option>
                    <option value="bandung_tengah" {{ old('category') == 'bandung_tengah' ? 'selected' : '' }}>Bandung Tengah
                        / Pusat Kota</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-1">Alamat Lengkap <span
                        class="text-red-500">*</span></label>
                <textarea name="address" rows="3" placeholder="Jl. Sukajadi No. 131..." required
                    class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">{{ old('address') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-1">Kapasitas Slot <span
                        class="text-red-500">*</span></label>
                <input type="number" name="total_slots" value="{{ old('total_slots') }}" min="1" placeholder="Contoh: 500"
                    required
                    class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
            </div>

            <button type="submit"
                class="bg-slate-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800 transition-all w-full shadow-lg shadow-slate-200">
                Simpan Data
            </button>
        </form>
    </div>
@endsection
