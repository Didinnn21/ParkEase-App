<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen lg:flex">

    <main class="flex-1 lg:ml-72 p-6 lg:p-12">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black text-slate-900">Manajemen Pengguna</h2>
                <p class="text-slate-400 font-medium">Kelola akses Petugas dan Pengguna Umum.</p>
            </div>
            <button onclick="document.getElementById('modalUser').classList.remove('hidden')"
                class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all text-sm">
                + TAMBAH PENGGUNA
            </button>
        </header>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[11px] font-black text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-5">Nama</th>
                        <th class="px-8 py-5">Email</th>
                        <th class="px-8 py-5">Role</th>
                        <th class="px-8 py-5">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($users as $user)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-8 py-6 font-bold text-slate-900">{{ $user->name }}</td>
                            <td class="px-8 py-6 text-slate-500 font-medium">{{ $user->email }}</td>
                            <td class="px-8 py-6">
                                <span
                                    class="px-3 py-1 rounded-lg text-[10px] font-black uppercase {{ $user->role == 'petugas' ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus pengguna ini?')">
                                    @csrf @method('DELETE')
                                    <button
                                        class="text-red-500 hover:text-red-700 font-bold text-xs uppercase">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <div id="modalUser"
        class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-10 shadow-2xl">
            <h3 class="text-2xl font-black text-slate-900 mb-6">Tambah Pengguna</h3>
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama</label>
                    <input type="text" name="name" required
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 mt-1 outline-none focus:border-blue-600 text-sm font-semibold">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email</label>
                    <input type="email" name="email" required
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 mt-1 outline-none focus:border-blue-600 text-sm font-semibold">
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Role</label>
                    <select name="role"
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 mt-1 outline-none focus:border-blue-600 text-sm font-semibold">
                        <option value="user">Pengguna Umum</option>
                        <option value="petugas">Petugas Lapangan</option>
                    </select>
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 mt-1 outline-none focus:border-blue-600 text-sm font-semibold">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('modalUser').classList.add('hidden')"
                        class="flex-1 bg-slate-100 text-slate-600 font-bold py-4 rounded-2xl uppercase tracking-widest text-xs">Batal</button>
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-100 uppercase tracking-widest text-xs">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
