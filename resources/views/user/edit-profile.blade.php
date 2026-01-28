<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - ParkEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-white min-h-screen pb-10">

    <div class="px-6 pt-12 pb-6 flex items-center gap-4 border-b border-slate-50">
        <a href="{{ route('user.profile') }}"
            class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-xl font-extrabold text-[#1A1A1A]">Edit Profile</h1>
    </div>

    <div class="px-6 mt-10">
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col items-center mb-10">
                <div class="relative">
                    <div
                        class="w-28 h-28 bg-slate-100 rounded-full flex items-center justify-center border-4 border-white shadow-sm overflow-hidden">
                        @if(Auth::user()->avatar)
                            <img id="avatarPreview" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}"
                                class="w-full h-full object-cover">
                        @else
                            <span id="avatarPlaceholder" class="text-slate-300 text-3xl font-bold">??</span>
                            <img id="avatarPreview" src="#" class="hidden w-full h-full object-cover">
                        @endif
                    </div>
                    <button type="button" onclick="document.getElementById('avatarInput').click()"
                        class="absolute bottom-1 right-1 w-8 h-8 bg-[#2D7CF6] rounded-full border-2 border-white flex items-center justify-center text-white shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>

                <input type="file" name="avatar" id="avatarInput" class="hidden" accept="image/*"
                    onchange="previewImage(this)">

                <button type="button" onclick="document.getElementById('avatarInput').click()"
                    class="mt-4 text-sm font-bold text-[#2D7CF6]">Ubah Foto Profile</button>
                @error('avatar') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all text-sm font-bold text-slate-700">
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:border-blue-600 focus:bg-white outline-none transition-all text-sm font-bold text-slate-700">
                @error('email') <p class="text-red-500 text-[10px] mt-1 ml-1 font-bold">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                class="w-full bg-[#2D7CF6] text-white font-extrabold py-5 rounded-[2rem] shadow-lg shadow-blue-100 transition-all active:scale-[0.98] uppercase tracking-widest text-xs mt-10">
                Simpan Perubahan
            </button>
        </form>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('avatarPreview');
            const placeholder = document.getElementById('avatarPlaceholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>
