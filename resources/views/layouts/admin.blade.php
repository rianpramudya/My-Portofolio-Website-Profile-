<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Portfolio</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Scrollbar custom untuk sidebar */
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }

        /* Fade-in untuk flash message */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fadeInDown 0.35s ease-out both; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-slate-900 text-white min-h-screen fixed top-0 left-0 z-50 flex flex-col border-r border-slate-800/80">
        
        {{-- Logo --}}
        <div class="h-16 flex items-center px-6 border-b border-slate-800 flex-shrink-0">
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-2.5 text-white font-bold tracking-tight hover:text-indigo-400 transition-colors duration-200 group">
                <span class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-900/50 group-hover:bg-indigo-500 transition-colors">
                    <i class="ph-fill ph-rocket text-base"></i>
                </span>
                <span class="text-base">Admin Panel</span>
            </a>
        </div>
        
        {{-- Navigasi --}}
        <nav class="sidebar-nav flex-1 p-3 space-y-0.5 overflow-y-auto">

            <p class="px-3 pt-4 pb-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Menu Utama</p>
            
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                      {{ request()->routeIs('admin.dashboard') 
                         ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' 
                         : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="ph ph-squares-four text-base w-4 text-center"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.contacts.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                      {{ request()->routeIs('admin.contacts*') 
                         ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' 
                         : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <span class="relative w-4 text-center">
                    <i class="ph ph-envelope-simple text-base"></i>
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="absolute -top-1 -right-1.5 w-2 h-2 bg-red-500 rounded-full border border-slate-900"></span>
                    @endif
                </span>
                Inbox
                @if(isset($unreadCount) && $unreadCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full leading-none">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>

            <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Konten</p>

            <a href="{{ route('admin.projects.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                      {{ request()->routeIs('admin.projects*') 
                         ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' 
                         : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="ph ph-briefcase text-base w-4 text-center"></i> Projects
            </a>

            <a href="{{ route('admin.experiences.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                      {{ request()->routeIs('admin.experiences*') 
                         ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' 
                         : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="ph ph-graduation-cap text-base w-4 text-center"></i> Experience
            </a>

            <a href="{{ route('admin.services.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                      {{ request()->routeIs('admin.services*') 
                         ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' 
                         : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="ph ph-sparkle text-base w-4 text-center"></i> Services
            </a>

            <a href="{{ route('admin.skills.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                      {{ request()->routeIs('admin.skills*') 
                         ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' 
                         : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="ph ph-code text-base w-4 text-center"></i> Skills
            </a>

            <p class="px-3 pt-5 pb-1.5 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Dokumen</p>

            <a href="{{ route('admin.cv.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                      {{ request()->routeIs('admin.cv*') 
                         ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' 
                         : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="ph ph-file-pdf text-base w-4 text-center"></i> Buat CV
            </a>

            <a href="{{ route('admin.letter.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-150
                      {{ request()->routeIs('admin.letter*') 
                         ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/30' 
                         : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <i class="ph ph-envelope-open text-base w-4 text-center"></i> Surat Lamaran
            </a>
        </nav>

        {{-- User & Logout --}}
        <div class="p-3 border-t border-slate-800 flex-shrink-0">
            <div class="flex items-center gap-3 px-3 py-2 mb-2 rounded-lg bg-slate-800/50">
                <div class="w-7 h-7 bg-indigo-600 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="min-w-0">
                    <div class="text-xs font-semibold text-slate-200 truncate">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] text-slate-500 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium text-slate-400
                               rounded-lg hover:bg-red-500/10 hover:text-red-400 transition-colors duration-150">
                    <i class="ph ph-sign-out text-sm"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN AREA ===== --}}
    <div class="ml-64 min-h-screen flex flex-col">

        {{-- Top Header --}}
        <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 sticky top-0 z-40 shadow-sm flex-shrink-0">
            <div class="flex items-center gap-2 text-slate-400 text-sm">
                <i class="ph ph-house text-base"></i>
                <span>/</span>
                <span class="font-semibold text-slate-700">@yield('header')</span>
            </div>
            
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors px-3 py-1.5 rounded-lg hover:bg-indigo-50">
                <i class="ph ph-arrow-square-out"></i> Lihat Website
            </a>
        </header>

        {{-- Content --}}
        <main class="flex-1 p-8 bg-slate-100">
            <div class="max-w-6xl mx-auto">

                @if(session('success'))
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-init="setTimeout(() => show = false, 3500)"
                         class="animate-fade-in-down bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm">
                        <i class="ph-fill ph-check-circle text-lg flex-shrink-0"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>