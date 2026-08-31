<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Portfolio</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ============================================================
         * GLOBAL
         * ============================================================ */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* ============================================================
         * SIDEBAR SCROLLBAR
         * ============================================================ */
        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
        .sidebar-nav::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }

        /* ============================================================
         * NAV ITEM — Active left-border glow indicator
         * ============================================================ */
        .nav-item-active {
            background: linear-gradient(90deg, rgba(99,102,241,0.15) 0%, rgba(99,102,241,0.06) 100%);
            color: #fff;
            border-left: 3px solid #6366f1;
        }
        .nav-item-active i {
            color: #a5b4fc;
        }
        .nav-item-inactive {
            color: #94a3b8;
            border-left: 3px solid transparent;
        }
        .nav-item-inactive:hover {
            background: rgba(255,255,255,0.05);
            color: #e2e8f0;
            border-left-color: #475569;
        }

        /* ============================================================
         * FLASH MESSAGE ANIMATIONS
         * ============================================================ */
        @keyframes slideInDown {
            from { opacity: 0; transform: translateY(-12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideOutUp {
            from { opacity: 1; transform: translateY(0); }
            to   { opacity: 0; transform: translateY(-12px); }
        }
        .flash-enter { animation: slideInDown 0.3s ease-out both; }
        .flash-exit  { animation: slideOutUp 0.3s ease-in both; }

        /* ============================================================
         * SIDEBAR MOBILE TRANSITION
         * Sidebar pakai transform, bukan display:none, agar
         * transisi slide bisa berjalan mulus.
         * ============================================================ */
        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #sidebar-overlay {
            transition: opacity 0.3s ease;
        }

        /* ============================================================
         * FORM INPUT — Global consistent style
         * ============================================================ */
        .form-input {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 0.625rem;
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            color: #1e293b;
            background: #f8fafc;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
            outline: none;
        }
        .form-input:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .form-input::placeholder { color: #94a3b8; }
    </style>
</head>

<body class="bg-slate-100 text-slate-800 antialiased">

    {{-- ================================================================
         OVERLAY — Mobile sidebar backdrop
         Klik overlay = tutup sidebar
         ================================================================ --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-black/40 backdrop-blur-[2px] z-40 opacity-0 pointer-events-none md:hidden">
    </div>

    {{-- ================================================================
         SIDEBAR
         Desktop : selalu terlihat (translate-x-0)
         Mobile  : tersembunyi di kiri (-translate-x-full), muncul via JS
         ================================================================ --}}
    <aside id="sidebar"
           class="w-64 bg-slate-900 text-white min-h-screen
                  fixed top-0 left-0 z-50
                  flex flex-col
                  border-r border-slate-800/60
                  -translate-x-full md:translate-x-0">

        {{-- ── Logo ── --}}
        <div class="h-16 flex items-center justify-between px-5 border-b border-slate-800/80 flex-shrink-0">
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-2.5 text-white font-bold tracking-tight
                      hover:text-indigo-400 transition-colors duration-200 group">
                <span class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center
                             shadow-lg shadow-indigo-900/50
                             group-hover:bg-indigo-500 group-hover:scale-105
                             transition-all duration-200">
                    <i class="ph-fill ph-rocket text-base"></i>
                </span>
                <span class="text-[15px]">Admin Panel</span>
            </a>
            {{-- Tombol tutup sidebar (mobile only) --}}
            <button id="sidebar-close-btn"
                    class="md:hidden p-1.5 rounded-lg text-slate-400
                           hover:text-white hover:bg-slate-800 transition-colors duration-150">
                <i class="ph ph-x text-base"></i>
            </button>
        </div>

        {{-- ── Navigasi ── --}}
        <nav class="sidebar-nav flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

            {{-- Grup: Menu Utama --}}
            <p class="px-3 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                Menu Utama
            </p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                      transition-all duration-150
                      {{ request()->routeIs('admin.dashboard')
                         ? 'nav-item-active'
                         : 'nav-item-inactive' }}">
                <i class="ph ph-squares-four text-base w-4 text-center flex-shrink-0"></i>
                Dashboard
            </a>

            <a href="{{ route('admin.contacts.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                      transition-all duration-150
                      {{ request()->routeIs('admin.contacts*')
                         ? 'nav-item-active'
                         : 'nav-item-inactive' }}">
                <span class="relative w-4 text-center flex-shrink-0">
                    <i class="ph ph-envelope-simple text-base"></i>
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="absolute -top-1 -right-1.5 w-2 h-2 bg-red-500
                                     rounded-full border border-slate-900 animate-pulse"></span>
                    @endif
                </span>
                Inbox
                @if(isset($unreadCount) && $unreadCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold
                                 px-1.5 py-0.5 rounded-full leading-none">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>

            {{-- Grup: Konten --}}
<p class="px-3 pt-5 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
    Konten
</p>

@php
    $navItems = [
        ['route' => 'admin.projects*',         'href' => 'admin.projects.index',         'icon' => 'ph-briefcase',        'label' => 'Projects'],
        ['route' => 'admin.experiences*',      'href' => 'admin.experiences.index',      'icon' => 'ph-graduation-cap',   'label' => 'Experience'],
        ['route' => 'admin.services*',         'href' => 'admin.services.index',         'icon' => 'ph-sparkle',          'label' => 'Services'],
        ['route' => 'admin.skills*',           'href' => 'admin.skills.index',           'icon' => 'ph-code',             'label' => 'Skills'],
        ['route' => 'admin.certifications*',   'href' => 'admin.certifications.index',   'icon' => 'ph-certificate',      'label' => 'Sertifikasi'],
    ];
@endphp

            @foreach($navItems as $item)
            <a href="{{ route($item['href']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                      transition-all duration-150
                      {{ request()->routeIs($item['route'])
                         ? 'nav-item-active'
                         : 'nav-item-inactive' }}">
                <i class="ph {{ $item['icon'] }} text-base w-4 text-center flex-shrink-0"></i>
                {{ $item['label'] }}
            </a>
            @endforeach

            {{-- Grup: Dokumen --}}
            <p class="px-3 pt-5 pb-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                Dokumen
            </p>

            <a href="{{ route('admin.cv.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                      transition-all duration-150
                      {{ request()->routeIs('admin.cv*')
                         ? 'nav-item-active'
                         : 'nav-item-inactive' }}">
                <i class="ph ph-file-pdf text-base w-4 text-center flex-shrink-0"></i>
                Buat CV
            </a>

            <a href="{{ route('admin.letter.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium
                      transition-all duration-150
                      {{ request()->routeIs('admin.letter*')
                         ? 'nav-item-active'
                         : 'nav-item-inactive' }}">
                <i class="ph ph-envelope-open text-base w-4 text-center flex-shrink-0"></i>
                Surat Lamaran
            </a>

        </nav>

        {{-- ── User & Logout ── --}}
        <div class="p-3 border-t border-slate-800/80 flex-shrink-0">
            <div class="flex items-center gap-3 px-3 py-2.5 mb-1.5 rounded-xl
                        bg-slate-800/60 border border-slate-700/40">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-600
                            rounded-full flex items-center justify-center
                            text-xs font-bold text-white flex-shrink-0 shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-xs font-semibold text-slate-200 truncate">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-[10px] text-slate-500 truncate">
                        {{ Auth::user()->email }}
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium
                               text-slate-400 rounded-lg
                               hover:bg-red-500/10 hover:text-red-400
                               active:scale-95
                               transition-all duration-150">
                    <i class="ph ph-sign-out text-sm"></i> Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- ================================================================
         MAIN AREA
         Desktop: ml-64 (sidebar visible)
         Mobile:  ml-0  (sidebar tersembunyi)
         ================================================================ --}}
    <div class="ml-0 md:ml-64 min-h-screen flex flex-col">

        {{-- ── Top Header ── --}}
        <header class="h-16 bg-white border-b border-slate-200
                       flex items-center justify-between
                       px-4 md:px-8
                       sticky top-0 z-30
                       shadow-sm flex-shrink-0">

            <div class="flex items-center gap-3">
                {{-- Hamburger button — mobile only --}}
                <button id="hamburger-btn"
                        class="md:hidden p-2 rounded-xl
                               text-slate-500 hover:text-indigo-600
                               hover:bg-indigo-50
                               active:scale-95
                               transition-all duration-150">
                    <i class="ph ph-list text-xl"></i>
                </button>

                {{-- Breadcrumb --}}
                <div class="flex items-center gap-1.5 text-slate-400 text-sm">
                    <i class="ph ph-house text-base text-slate-400"></i>
                    <i class="ph ph-caret-right text-xs text-slate-300"></i>
                    <span class="font-semibold text-slate-700">@yield('header', 'Dashboard')</span>
                </div>
            </div>

            {{-- Aksi Header --}}
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center gap-1.5 text-xs font-medium text-slate-500
                      hover:text-indigo-600
                      px-3 py-2 rounded-lg hover:bg-indigo-50
                      transition-all duration-150
                      border border-transparent hover:border-indigo-200">
                <i class="ph ph-arrow-square-out text-sm"></i>
                <span class="hidden sm:inline">Lihat Website</span>
            </a>

        </header>

        {{-- ── Content Area ── --}}
        <main class="flex-1 p-4 md:p-8 bg-slate-100">
            <div class="max-w-6xl mx-auto">

                {{-- ── Flash Message ──
                     ✅ FIX: Tidak lagi pakai Alpine.js.
                        Diganti dengan vanilla JS + CSS animation.
                        Auto-dismiss setelah 3.5 detik.
                     ──────────────────────────────────────────── --}}
                @if(session('success'))
                    <div id="flash-message"
                         class="flash-enter mb-6
                                bg-emerald-50 border border-emerald-200 text-emerald-700
                                px-4 py-3.5 rounded-xl
                                flex items-center justify-between gap-3
                                shadow-sm shadow-emerald-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="ph-fill ph-check-circle text-emerald-600 text-lg"></i>
                            </div>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                        {{-- Tombol tutup manual --}}
                        <button onclick="dismissFlash()"
                                class="text-emerald-400 hover:text-emerald-600 transition-colors flex-shrink-0">
                            <i class="ph ph-x text-sm"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div id="flash-message-error"
                         class="flash-enter mb-6
                                bg-red-50 border border-red-200 text-red-700
                                px-4 py-3.5 rounded-xl
                                flex items-center justify-between gap-3
                                shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="ph-fill ph-warning-circle text-red-600 text-lg"></i>
                            </div>
                            <span class="text-sm font-medium">{{ session('error') }}</span>
                        </div>
                        <button onclick="this.closest('[id^=flash]').remove()"
                                class="text-red-400 hover:text-red-600 transition-colors flex-shrink-0">
                            <i class="ph ph-x text-sm"></i>
                        </button>
                    </div>
                @endif

                @yield('content')

            </div>
        </main>

    </div>

    {{-- ================================================================
         SCRIPTS
         ================================================================ --}}
    <script>
        /* ─────────────────────────────────────────────────────────────
         * MOBILE SIDEBAR
         * ───────────────────────────────────────────────────────────── */
        const sidebar       = document.getElementById('sidebar');
        const overlay       = document.getElementById('sidebar-overlay');
        const hamburgerBtn  = document.getElementById('hamburger-btn');
        const closeBtn      = document.getElementById('sidebar-close-btn');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
            document.body.style.overflow = 'hidden'; // Cegah scroll body saat sidebar terbuka
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        }

        if (hamburgerBtn) hamburgerBtn.addEventListener('click', openSidebar);
        if (closeBtn)     closeBtn.addEventListener('click', closeSidebar);
        if (overlay)      overlay.addEventListener('click', closeSidebar);

        /* ─────────────────────────────────────────────────────────────
         * FLASH MESSAGE — Auto-dismiss
         * ✅ FIX: Menggantikan Alpine.js yang tidak ter-load.
         *    Menggunakan vanilla JS dengan CSS animation.
         * ───────────────────────────────────────────────────────────── */
        function dismissFlash() {
            const flash = document.getElementById('flash-message');
            if (!flash) return;
            flash.classList.replace('flash-enter', 'flash-exit');
            setTimeout(() => flash.remove(), 320);
        }

        // Auto-dismiss setelah 3.5 detik
        const flashEl = document.getElementById('flash-message');
        if (flashEl) {
            setTimeout(dismissFlash, 3500);
        }
    </script>

</body>
</html>