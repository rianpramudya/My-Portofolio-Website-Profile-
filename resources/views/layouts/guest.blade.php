<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portfolio') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Animasi Blob Kreatif (Bergerak & Bernafas) */
        @keyframes float {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        @keyframes float-reverse {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(-30px, 50px) scale(0.9); }
            66% { transform: translate(20px, -20px) scale(1.1); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        .animate-blob { animation: float 10s infinite ease-in-out; }
        .animate-blob-reverse { animation: float-reverse 12s infinite ease-in-out; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>
</head>
<body class="font-sans text-slate-900 antialiased relative min-h-screen flex flex-col justify-center items-center overflow-hidden bg-slate-50">

    <!-- BACKGROUND KREATIF -->
    <div class="fixed inset-0 z-0 pointer-events-none bg-white">
        <!-- Gradient Base -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-fuchsia-50 opacity-80"></div>

        <!-- Colorful Blobs (Bola Warna-Warni) -->
        <!-- Ungu Kiri Atas -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-purple-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob"></div>
        <!-- Kuning Kanan Atas -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-yellow-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob animation-delay-2000"></div>
        <!-- Pink Bawah Kiri -->
        <div class="absolute bottom-[-100px] left-[20%] w-[600px] h-[600px] bg-pink-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob-reverse animation-delay-4000"></div>
        <!-- Indigo Bawah Kanan -->
        <div class="absolute bottom-[-100px] right-[-100px] w-[500px] h-[500px] bg-indigo-300 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 animate-blob"></div>

        <!-- Grid Overlay (Tekstur Halus) -->
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
    </div>

    <!-- Logo & Brand -->
    <div class="relative z-10 mb-8 text-center">
        <a href="/" class="inline-flex items-center gap-3 group">
            <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-fuchsia-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-xl shadow-indigo-500/20 group-hover:scale-110 transition duration-300 rotate-3 group-hover:rotate-6">
                R
            </div>
            <span class="text-3xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-fuchsia-600 drop-shadow-sm">
                Rian<span class="text-slate-800">.dev</span>
            </span>
        </a>
    </div>

    <!-- Card Container (Efek Glassmorphism) -->
    <div class="relative z-10 w-full sm:max-w-md px-8 py-10 bg-white/70 backdrop-blur-xl shadow-2xl shadow-indigo-100/50 border border-white/50 rounded-3xl transition-all duration-500 hover:shadow-indigo-200/50">
        {{ $slot }}
    </div>

    <div class="relative z-10 mt-8 text-center text-xs text-slate-400 font-medium">
        &copy; {{ date('Y') }} Rian Pramudya. <span class="text-indigo-400">Crafted with Creativity.</span>
    </div>
</body>
</html>