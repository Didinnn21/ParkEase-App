@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
    <div>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Data Pengguna</h2>
        <p class="text-slate-400 font-medium mt-1">Kelola akaun Petugas dan User aplikasi.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm h-fit">
        <h3 class="font-black text-slate-900 text-lg mb-6">Tambah Pengguna Baru</h3>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Email</label>
                <input type="email" name="email" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Password</label>
                <input type="password" name="password" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Role (Peran)</label>
                {{-- Tambah id="role_select" dan onchange untuk JavaScript --}}
                <select name="role" id="role_select" onchange="toggleLocationInput()" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold focus:outline-none focus:border-blue-500">
                    <option value="user">User (Pengguna Umum)</option>
                    <option value="petugas">Petugas Parkir</option>
                </select>
            </div>

            {{-- Input Lokasi (Disembunyikan secara default, muncul jika Petugas dipilih) --}}
            <div id="location_input_container" class="hidden bg-blue-50 p-4 rounded-xl border border-blue-100">
                <label class="block text-xs font-bold text-blue-600 uppercase mb-2">Tugaskan di Lokasi Mana?</label>
                <select name="parking_location_id" class="w-full bg-white border border-blue-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700">
                    <option value="" disabled selected>-- Pilih Lokasi --</option>
                    @foreach($locations as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->name }} ({{ $loc->region }})</option>
                    @endforeach
                </select>
                <p class="text-[10px] text-blue-400 mt-2">*Petugas hanya boleh mengurus lokasi yang dipilih ini.</p>
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-slate-800 transition-all mt-4">
                + Tambah Pengguna
            </button>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Nama & Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Lokasi Bertugas</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $user->name }}</div>
                            <div class="text-xs text-slate-400">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase {{ $user->role == 'petugas' ? 'bg-purple-100 text-purple-600' : 'bg-slate-100 text-slate-500' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs font-medium text-slate-600">
                            @if($user->role == 'petugas' && $user->location)
                                {{ $user->location->name }}
                            @elseif($user->role == 'petugas')
                                <span class="text-red-400 italic">Belum ditentukan</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 font-bold text-xs">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-12 text-center text-slate-400 text-sm">Belum ada pengguna.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Script mudah untuk tunjuk/sembunyi dropdown lokasi
    function toggleLocationInput() {
        const role = document.getElementById('role_select').value;
        const container = document.getElementById('location_input_container');
        if (role === 'petugas') {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }
    // Jalankan sekali saat load (jika form kembali dari error validation)
    document.addEventListener('DOMContentLoaded', toggleLocationInput);
</script>
@endsection
