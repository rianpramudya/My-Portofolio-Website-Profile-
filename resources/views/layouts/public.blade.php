<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ Str::limit($profile->about_text ?? '', 160) }}">
    <meta name="theme-color" content="#101113">
    <title>@yield('title', 'Portfolio')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/public.css', 'resources/js/public.js'])
</head>
<body class="public-site">
    <a href="#main-content" class="skip-link">Langsung ke konten</a>
    <header class="public-header">
        <div class="shell nav-shell">
            <a class="identity" href="#home" aria-label="Beranda {{ $profile->name }}">
                <span class="identity-mark" aria-hidden="true">{{ collect(preg_split('/\s+/', trim($profile->name ?? '')))->filter()->take(2)->map(fn($part) => mb_substr($part, 0, 1))->implode('') ?: '—' }}</span>
                <span class="identity-name">{{ $profile->name ?: 'Portfolio' }}<small>{{ $profile->headline }}</small></span>
            </a>
            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="public-nav"><span>Menu</span><span class="menu-lines" aria-hidden="true"></span></button>
            <nav id="public-nav" class="public-nav" aria-label="Navigasi publik">
                <a href="#about">Profil</a><a href="#projects">Proyek</a><a href="#skills">Keahlian</a><a href="#certifications">Sertifikasi</a><a href="#contact">Kontak <span aria-hidden="true">↗</span></a>
                @auth
                    <a href="{{ route('admin.dashboard') }}">Dashboard <span aria-hidden="true">↗</span></a>
                @endauth
            </nav>
        </div>
    </header>
    <main id="main-content" tabindex="-1">@yield('content')</main>
    <footer class="public-footer shell">
        <div><span class="footer-name">{{ $profile->name ?: 'Portfolio' }}</span><p>© {{ now()->year }}{{ $profile->name ? ' · '.$profile->name : '' }}</p></div>
        <div class="footer-links"><a href="#home">Kembali ke atas ↑</a>@auth<a href="{{ route('admin.dashboard') }}">Dashboard ↗</a>@endauth</div>
    </footer>
</body>
</html>
