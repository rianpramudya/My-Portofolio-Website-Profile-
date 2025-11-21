<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portfolio Rian Pramudya')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://fav.farm/⚡">

    <!-- Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Panggil CSS Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Dot Pattern Background */
        .bg-grid-pattern {
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased relative">

    <!-- Scroll Progress Bar -->
    <div class="fixed top-0 left-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 z-[60] transition-all duration-100"
        id="progress-bar" style="width: 0%"></div>

    <!-- Background Texture -->
    <div class="fixed inset-0 z-[-1] bg-grid-pattern opacity-[0.4] pointer-events-none"></div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 ease-in-out" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="group flex items-center gap-3">
                        <!-- Icon Logo -->
                        <div class="relative flex items-center justify-center w-10 h-10">
                            <!-- Background Gradient dengan Rotasi & Shadow -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-xl shadow-lg shadow-indigo-500/30 group-hover:rotate-6 group-hover:scale-105 transition-all duration-300">
                            </div>

                            <!-- Huruf R -->
                            <span
                                class="relative text-white font-bold text-xl font-sans z-10 group-hover:-rotate-3 transition-transform duration-300">R</span>

                            <!-- Aksen Titik (Dot) -->
                            <div
                                class="absolute -top-1 -right-1 w-3 h-3 bg-white rounded-full border-2 border-white z-20 shadow-sm">
                                <div class="w-full h-full bg-pink-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>

                        <!-- Text Logo -->
                        <div class="flex flex-col leading-none">
                            <span
                                class="text-lg font-extrabold text-slate-900 tracking-tight group-hover:text-indigo-600 transition-colors duration-300">
                                Rian<span class="text-indigo-600">.Portofolio</span>
                            </span>
                            <span
                                class="text-[10px] font-medium text-slate-400 tracking-widest uppercase group-hover:text-indigo-400 transition-colors duration-300">
                                Pramudya Amanda
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Menu (PERBAIKAN: Menggunakan gap-8 agar tidak menempel) -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#home"
                        class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition py-2 relative group">
                        Home
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#about"
                        class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition py-2 relative group">
                        Tentang
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#experience"
                        class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition py-2 relative group">
                        Pengalaman
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#projects"
                        class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition py-2 relative group">
                        Proyek
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    <!-- Pembatas Vertikal -->
                    <div class="h-6 w-px bg-slate-200"></div>

                    <!-- Area Tombol Action -->
                    <div class="flex items-center gap-4">
                        <!-- LOGIKA AUTHENTICATION (LOGIN/DASHBOARD) -->
                        @auth
                        <!-- Jika Sudah Login -->
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition flex items-center gap-1">
                            <i class="ph-fill ph-squares-four"></i> Dashboard
                        </a>
                        @else
                        <!-- Jika Belum Login -->
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}"
                                class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">
                                Register
                            </a>
                        </div>
                        @endauth

                        <a href="#contact"
                            class="px-5 py-2.5 bg-slate-900 text-white text-sm font-medium rounded-full hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                            Hubungi Saya
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-slate-600 hover:text-indigo-600 focus:outline-none p-2">
                        <i class="ph ph-list text-2xl" id="menu-icon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-white/95 backdrop-blur-xl border-t border-slate-100 absolute w-full left-0 shadow-xl">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="#home"
                    class="mobile-link block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50">Home</a>
                <a href="#about"
                    class="mobile-link block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50">Tentang</a>
                <a href="#experience"
                    class="mobile-link block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50">Pengalaman</a>
                <a href="#projects"
                    class="mobile-link block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50">Proyek</a>

                <div class="border-t border-slate-100 my-2"></div>

                <!-- LOGIKA AUTH MOBILE -->
                @auth
                <a href="{{ route('admin.dashboard') }}"
                    class="mobile-link block px-3 py-2 rounded-lg text-base font-bold text-indigo-600 hover:bg-indigo-50 flex items-center gap-2">
                    <i class="ph-fill ph-squares-four"></i> Ke Dashboard Admin
                </a>
                @else
                <a href="{{ route('login') }}"
                    class="mobile-link block px-3 py-2 rounded-lg text-base font-medium text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 flex items-center gap-2">
                    <i class="ph ph-sign-in"></i> Login
                </a>
                <a href="{{ route('register') }}"
                    class="mobile-link block px-3 py-2 rounded-lg text-base font-bold text-indigo-600 hover:bg-indigo-50 flex items-center gap-2">
                    <i class="ph ph-user-plus"></i> Register Admin
                </a>
                @endauth

                <div class="pt-2">
                    <a href="#contact"
                        class="mobile-link block w-full text-center px-5 py-3 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 shadow-lg shadow-indigo-500/30">
                        Hubungi Saya
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- AREA KONTEN DINAMIS -->
    <main>
        @yield('content')
    </main>

    <!-- Modern Footer -->
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-8 border-t border-slate-800 mt-auto relative overflow-hidden">
        <!-- Decorative Glow in Footer -->
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-1 bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-50">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ route('home') }}" class="group flex items-center gap-3 mb-6">
                        <!-- Icon Logo -->
                        <div class="relative flex items-center justify-center w-10 h-10 flex-shrink-0">
                            <!-- Background Gradient dengan Rotasi & Shadow -->
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-violet-600 rounded-xl shadow-lg shadow-indigo-500/30 group-hover:rotate-6 group-hover:scale-105 transition-all duration-300">
                            </div>

                            <!-- Huruf R -->
                            <span class="relative text-white font-bold text-xl font-sans z-10 group-hover:-rotate-3 transition-transform duration-300">R</span>

                            <!-- Aksen Titik (Dot) -->
                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-white rounded-full border-2 border-slate-900 z-20 shadow-sm">
                                <div class="w-full h-full bg-pink-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>

                        <!-- Text Logo -->
                        <div class="flex flex-col leading-none">
                            <span class="text-lg font-extrabold text-white tracking-tight group-hover:text-indigo-400 transition-colors duration-300">
                                Rian<span class="text-indigo-500">.Portofolio</span>
                            </span>
                            <span class="text-[10px] font-medium text-slate-500 tracking-widest uppercase group-hover:text-indigo-300 transition-colors duration-300 mt-0.5">
                                Pramudya Amanda
                            </span>
                        </div>
                    </a>
                    
                    <p class="text-slate-400 leading-relaxed mb-6 max-w-sm text-sm">
                        Membangun solusi digital yang estetik, fungsional, dan berkinerja tinggi untuk membantu bisnis
                        Anda tumbuh di era digital.
                    </p>
                    
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-indigo-600 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-transparent hover:shadow-indigo-500/30">
                            <i class="ph-fill ph-github-logo text-xl"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-transparent hover:shadow-blue-500/30">
                            <i class="ph-fill ph-linkedin-logo text-xl"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-pink-600 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-transparent hover:shadow-pink-500/30">
                            <i class="ph-fill ph-instagram-logo text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-white font-bold mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="hover:text-indigo-400 transition">Home</a></li>
                        <li><a href="#about" class="hover:text-indigo-400 transition">Tentang Saya</a></li>
                        <li><a href="#projects" class="hover:text-indigo-400 transition">Portofolio</a></li>
                        <li><a href="#contact" class="hover:text-indigo-400 transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="text-white font-bold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-indigo-400 transition">Web Development</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">API Integration</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">UI/UX Implementation</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">System Architecture</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p>&copy; {{ date('Y') }} Rian Pramudya. All rights reserved.</p>
                <p class="flex items-center gap-1">
                    Dibuat dengan <i class="ph-fill ph-heart text-red-500 animate-pulse"></i> menggunakan Laravel 11
                </p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-indigo-600 text-white p-3 rounded-full shadow-lg translate-y-20 opacity-0 transition-all duration-300 hover:bg-indigo-700 z-40">
        <i class="ph ph-arrow-up text-xl"></i>
    </button>

    <!-- Scripts -->
    <script>
        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        const progressBar = document.getElementById('progress-bar');
        const backToTopBtn = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            // Glassmorphism on scroll
            if (window.scrollY > 10) {
                navbar.classList.add('bg-white/80', 'backdrop-blur-md', 'shadow-sm');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.remove('bg-white/80', 'backdrop-blur-md', 'shadow-sm');
                navbar.classList.add('bg-transparent');
            }

            // Scroll Progress Bar
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + "%";

            // Back to Top Button
            if (window.scrollY > 500) {
                backToTopBtn.classList.remove('translate-y-20', 'opacity-0');
            } else {
                backToTopBtn.classList.add('translate-y-20', 'opacity-0');
            }
        });

        // Back to Top Action
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            if(menu.classList.contains('hidden')){
                icon.classList.replace('ph-x', 'ph-list');
            } else {
                icon.classList.replace('ph-list', 'ph-x');
            }
        });

        // Close mobile menu when link clicked
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
                icon.classList.replace('ph-x', 'ph-list');
            });
        });
    </script>
</body>

</html>