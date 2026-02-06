<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ParkEase Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { DEFAULT: '#2D7CF6', dark: '#1A68D8', light: '#EAF2FF' },
                        dark: '#1A1A1A',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .active-menu {
            background-color: #EAF2FF;
            color: #2D7CF6;
            font-weight: 800;
        }
        .active-menu svg { stroke-width: 2.5; }

        /* Transisi Sidebar Mobile */
        #sidebar { transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-[#F8F9FA] text-[#333]">

    <div id="mobile-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden glass"></div>

    <div class="flex min-h-screen relative">

        <aside id="sidebar" class="w-72 bg-white border-r border-slate-100 flex-shrink-0 fixed inset-y-0 left-0 z-40 transform -translate-x-full lg:translate-x-0">
            <div class="p-8 h-full flex flex-col">

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 mb-10 group cursor-pointer">
                    <img src="{{ asset('assets/img/Logo_ParkEasy.jpeg') }}"
     alt="ParkEase Logo"
     class="w-10 h-10 rounded-xl object-cover shadow-lg shadow-brand/30 group-hover:scale-105 transition-transform">
                    <div>
                        <h1 class="font-extrabold text-xl text-dark leading-none tracking-tight group-hover:text-brand transition-colors">ParkEase</h1>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Admin Portal</p>
                    </div>
                </a>

                <nav class="space-y-2 flex-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-sm font-bold text-slate-500 hover:bg-slate-50 hover:text-dark transition-all {{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.locations.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-sm font-bold text-slate-500 hover:bg-slate-50 hover:text-dark transition-all {{ request()->routeIs('admin.locations.*') ? 'active-menu' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lokasi Parkir
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-sm font-bold text-slate-500 hover:bg-slate-50 hover:text-dark transition-all {{ request()->routeIs('admin.users.*') ? 'active-menu' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Petugas & User
                    </a>

                    <a href="{{ route('admin.history.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl text-sm font-bold text-slate-500 hover:bg-slate-50 hover:text-dark transition-all {{ request()->routeIs('admin.history.*') ? 'active-menu' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Riwayat Aktivitas
                    </a>
                </nav>

                <div class="mt-auto">
                    <div class="bg-slate-50 p-4 rounded-2xl flex items-center gap-3 border border-slate-100">
                        <a href="{{ route('profile.edit') }}" class="block flex-shrink-0 group">
                        <img class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm group-hover:border-blue-200 transition-all"
                             src="{{ Auth::user()->photo_url }}"
                             alt="{{ Auth::user()->name }}">
                        </a>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-dark truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="text-slate-400 hover:text-red-500 transition-colors" title="Logout">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 lg:ml-72 p-6 lg:p-10 min-w-0">

            <div class="lg:hidden mb-8 flex justify-between items-center bg-white p-5 rounded-[2rem] shadow-sm border border-slate-100 sticky top-4 z-20">
                <div class="flex items-center gap-3">
                   <img src="{{ asset('assets/img/Logo_ParkEasy.jpeg') }}"
     alt="ParkEase Logo"
     class="w-8 h-8 rounded-lg object-cover">
                    <span class="font-extrabold text-lg text-dark">ParkEase</span>
                </div>
                <button onclick="toggleSidebar()" class="p-2 bg-slate-50 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-brand transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>

            <div class="animate-fade-in-up">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-2xl text-sm font-bold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');

            // Cek apakah sidebar sedang tersembunyi (-translate-x-full)
            if (sidebar.classList.contains('-translate-x-full')) {
                // BUKA SIDEBAR
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                // TUTUP SIDEBAR
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }
    </script>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.4s ease-out forwards;
        }
    </style>
</body>
</html>
