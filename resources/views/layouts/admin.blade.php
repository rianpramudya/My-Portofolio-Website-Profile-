<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Portfolio</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- Sidebar (Fixed Left) -->
    <aside class="w-64 bg-slate-900 text-white min-h-screen fixed top-0 left-0 z-50 flex flex-col transition-all duration-300 border-r border-slate-800">
        <!-- Logo Area -->
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <a href="{{ route('home') }}" target="_blank" class="text-xl font-bold tracking-tight flex items-center gap-2 hover:text-indigo-400 transition">
                <i class="ph-fill ph-rocket text-indigo-500"></i> Admin Panel
            </a>
        </div>
        
        <!-- Menu Navigasi -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <p class="px-4 pt-4 pb-2 text-xs font-bold text-slate-500 uppercase tracking-wider">Menu Utama</p>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition">
                <i class="ph ph-squares-four text-lg"></i> Dashboard
            </a>

            <!-- MENU INBOX -->
            <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.contacts*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition group">
                <i class="ph ph-envelope-simple text-lg relative">
                    <!-- Titik Merah di Ikon jika ada pesan baru -->
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 border-2 border-slate-900 rounded-full"></span>
                    @endif
                </i>
                Inbox
                
                <!-- Badge Angka/New di Kanan -->
                @if(isset($unreadCount) && $unreadCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm animate-pulse">
                        {{ $unreadCount }} New
                    </span>
                @endif
            </a>
            
            <p class="px-4 pt-6 pb-2 text-xs font-bold text-slate-500 uppercase tracking-wider">Manajemen Konten</p>
            
            <!-- Projects -->
            <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.projects*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition">
                <i class="ph ph-briefcase text-lg"></i> Projects
            </a>

            <!-- Experience -->
            <a href="{{ route('admin.experiences.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.experiences*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition">
                <i class="ph ph-graduation-cap text-lg"></i> Experience
            </a>

            <!-- Services (Layanan) -->
            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.services*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition">
                <i class="ph ph-squares-four text-lg"></i> Services
            </a>

            <!-- Skills -->
            <a href="{{ route('admin.skills.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.skills*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition">
                <i class="ph ph-code text-lg"></i> Skills
            </a>

            <p class="px-4 pt-6 pb-2 text-xs font-bold text-slate-500 uppercase tracking-wider">Generator Dokumen</p>

            <!-- Buat CV -->
            <a href="{{ route('admin.cv.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.cv*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition">
                <i class="ph ph-file-pdf text-lg"></i> Buat CV
            </a>

            <!-- Buat Surat Lamaran -->
            <a href="{{ route('admin.letter.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.letter*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition">
                <i class="ph ph-envelope-open text-lg"></i> Surat Lamaran
            </a>
        </nav>

        <!-- Tombol Logout -->
        <div class="p-4 border-t border-slate-800 bg-slate-900">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm text-red-400 bg-slate-800/50 rounded-lg hover:bg-red-500/10 hover:text-red-300 transition border border-transparent hover:border-red-500/20">
                    <i class="ph ph-sign-out text-lg"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="ml-64 min-h-screen flex flex-col">
        <!-- Top Header -->
        <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 sticky top-0 z-40 shadow-sm">
            <h1 class="text-lg font-bold text-slate-800">@yield('header')</h1>
            
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <div class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="w-9 h-9 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold border border-indigo-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Content Wrapper -->
        <div class="flex-1 p-8 overflow-y-auto bg-slate-50">
            <div class="max-w-6xl mx-auto">
                <!-- Flash Message Global -->
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm animate-fade-in-down">
                        <i class="ph-fill ph-check-circle text-xl"></i> 
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>

</body>
</html>