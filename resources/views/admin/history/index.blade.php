@extends('layouts.admin')

@section('title', 'Riwayat Aktivitas')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Laporan Aktivitas</h2>
            <p class="text-slate-400 font-medium">Rekam jejak keluar-masuk kendaraan oleh petugas.</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
        <form action="{{ route('admin.history.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Lokasi</label>
                <select name="location_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500">
                    <option value="">Semua Lokasi</option>
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>
                            {{ $loc->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Petugas</label>
                <select name="user_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500">
                    <option value="">Semua Petugas</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-1">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition-all w-full shadow-lg shadow-blue-200">
                    Filter Data
                </button>
                <a href="{{ route('admin.history.index') }}" class="bg-slate-100 text-slate-500 px-4 py-3 rounded-xl text-sm font-bold hover:bg-slate-200 transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Petugas</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4">Aksi</th>
                        <th class="px-6 py-4 text-center">Perubahan Slot</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($histories as $history)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-xs font-bold text-slate-500">
                            {{ $history->created_at->format('d M Y') }} <br>
                            <span class="text-slate-400 font-mono">{{ $history->created_at->format('H:i:s') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $history->user->name ?? 'Sistem' }}</div>
                        </td>
                        <td class="px-6 py-4 text-xs font-medium text-slate-600">
                            {{ $history->location->name ?? 'Dihapus' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($history->action == 'decrement')
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-[10px] font-black uppercase">Masuk</span>
                            @else
                                <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-lg text-[10px] font-black uppercase">Keluar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center text-xs font-mono text-slate-500">
                            {{ $history->previous_available }} <span class="text-slate-300">➜</span> <span class="font-bold text-slate-900">{{ $history->new_available }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400 text-sm font-medium">
                            Tidak ada data yang ditemukan sesuai filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-slate-50">
            {{ $histories->links() }}
        </div>
    </div>
</div>
@endsection
