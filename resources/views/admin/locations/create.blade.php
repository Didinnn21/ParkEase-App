@extends('layouts.admin')

@section('title', 'Tambah Lokasi')

@section('content')
    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm max-w-2xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-slate-800">Tambah Lokasi Baru</h2>
            <a href="{{ route('admin.locations.index') }}" class="text-sm text-slate-500 hover:text-blue-600">
                &larr; Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.locations.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lokasi</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-1">Kategori</label>
                <select name="category" required
                    class="w-full border border-slate-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:border-blue-500">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="umum">Umum</option>
                    <option value="mall">Mall</option>
                    <option value="pasar">Pasar</option>
                    <option value="bandung_tengah">Bandung Tengah</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-slate-700 mb-1">Alamat</label>
                <textarea name="address" rows="3" required
                    class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500">{{ old('address') }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-slate-700 mb-1">Total Slot</label>
                <input type="number" name="total_slots" value="{{ old('total_slots') }}" min="1" required
                    class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:border-blue-500">
            </div>

            <button type="submit"
                class="bg-slate-900 text-white px-6 py-2 rounded-lg font-bold hover:bg-slate-800 transition-colors w-full">
                Simpan Data
            </button>
        </form>
    </div>
@endsection
