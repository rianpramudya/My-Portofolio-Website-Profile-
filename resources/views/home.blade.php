@extends('layouts.app')

{{-- Judul Halaman Mengambil Nama dari Database --}}
@section('title', ($profile->name ?? 'Portfolio') . ' - ' . ($profile->headline ?? 'Web Developer'))

@section('content')

    {{-- ================================================================
         HERO SECTION
         ================================================================ --}}
    {{-- PERBAIKAN: Padding diperkecil di mobile (pt-24 pb-16), membesar di md --}}
    <section id="home" class="relative pt-24 pb-16 md:pt-32 md:pb-24 bg-slate-50" style="overflow-x: clip;">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-72 h-72 md:w-96 md:h-96 bg-indigo-100 rounded-full blur-3xl opacity-50 animate-pulse pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 md:w-80 md:h-80 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- PERUBAHAN: Memaksa flex-row (kiri-kanan) di SEMUA layar. Menghapus lg:flex-row --}}
            <div class="flex flex-row items-center gap-4 sm:gap-10 lg:gap-16">

                {{-- Teks Hero --}}
                <div class="w-3/5 space-y-4 sm:space-y-6 md:space-y-8 text-left"
                     data-aos="fade-right"
                     data-aos-duration="1000">

                    <div class="inline-flex items-center px-2 sm:px-4 py-1 sm:py-2 rounded-full bg-white border border-slate-200 shadow-sm text-[8px] sm:text-xs md:text-sm font-medium text-slate-600 mb-1 sm:mb-4">
                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-green-500 rounded-full mr-1.5 sm:mr-2 animate-ping"></span>
                        <span class="hidden sm:inline">Available for Freelance & Hiring</span>
                        <span class="sm:hidden">Available</span> {{-- Teks lebih pendek di mobile agar muat --}}
                    </div>

                    {{-- HEADLINE DINAMIS --}}
                    {{-- Ukuran font dikecilkan drastis di mobile agar muat bersebelahan --}}
                    <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        @php
                            $headline  = $profile->headline ?? 'Web Developer';
                            $words     = explode(' ', $headline);
                            $firstWord = array_shift($words);
                            $restWords = implode(' ', $words);
                        @endphp

                        @if($firstWord)
                            {{ $firstWord }}
                            <br> {{-- Selalu enter --}}
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">
                                {{ $restWords }}
                            </span>
                        @else
                            Web Developer
                        @endif
                    </h1>

                    {{-- ABOUT TEXT DINAMIS --}}
                    <p class="text-[10px] sm:text-base md:text-xl text-slate-600 max-w-2xl leading-relaxed">
                        {{ $profile->about_text }}
                    </p>

                    {{-- TOMBOL --}}
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-4 justify-start pt-1 md:pt-4">
                        <a href="#projects"
                           class="px-3 py-1.5 sm:px-6 sm:py-3 md:px-8 md:py-4 bg-slate-900 text-white rounded-lg sm:rounded-xl text-[10px] sm:text-sm md:text-base font-bold hover:bg-slate-800 transition-all duration-300 shadow-xl shadow-slate-900/20 flex items-center justify-center gap-1 sm:gap-2 hover:-translate-y-0.5">
                            Lihat Karya <span class="hidden sm:inline">Saya</span> <i class="ph ph-arrow-down"></i>
                        </a>
                        <a href="mailto:{{ $profile->email }}"
                           class="px-3 py-1.5 sm:px-6 sm:py-3 md:px-8 md:py-4 bg-white text-slate-900 border border-slate-200 rounded-lg sm:rounded-xl text-[10px] sm:text-sm md:text-base font-bold hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300 flex items-center justify-center gap-1 sm:gap-2 hover:-translate-y-0.5">
                            <i class="ph ph-chat-circle-text text-sm sm:text-lg md:text-xl"></i> <span class="hidden sm:inline">Hubungi Saya</span><span class="sm:hidden">Kontak</span>
                        </a>
                    </div>

                    {{-- STATS --}}
                    <div class="pt-3 sm:pt-6 md:pt-8 flex gap-3 sm:gap-6 md:gap-8 justify-start border-t border-slate-200 mt-3 sm:mt-6 md:mt-8">
                        <div>
                            <span class="block text-sm sm:text-2xl md:text-3xl font-bold text-slate-900">{{ $experiences->count() }}+</span>
                            <span class="text-[8px] sm:text-xs md:text-sm text-slate-500">Posisi</span>
                        </div>
                        <div>
                            <span class="block text-sm sm:text-2xl md:text-3xl font-bold text-slate-900">{{ $projects->count() }}+</span>
                            <span class="text-[8px] sm:text-xs md:text-sm text-slate-500">Proyek</span>
                        </div>
                    </div>
                </div>

                {{-- Foto Hero --}}
                <div class="w-2/5 flex justify-end mt-0"
                     data-aos="zoom-in"
                     data-aos-duration="1200"
                     data-aos-delay="200">

                    {{-- Ukuran kotak gambar menyesuaikan secara proporsional --}}
                    <div class="relative w-32 h-32 sm:w-64 sm:h-64 md:w-80 md:h-80 lg:w-96 lg:h-96">
                        <div class="absolute inset-0 bg-gradient-to-tr from-indigo-600 to-blue-500 rounded-xl sm:rounded-[1.5rem] lg:rounded-[2rem] rotate-6 opacity-20"></div>

                        <div class="absolute inset-0 bg-white rounded-xl sm:rounded-[1.5rem] lg:rounded-[2rem] shadow-xl sm:shadow-2xl overflow-hidden border-2 sm:border-4 border-white hover:-rotate-2 transition-transform duration-500 cursor-pointer">
                            @if($profile->avatar)
                                <img src="{{ asset('storage/' . $profile->avatar) }}"
                                     alt="{{ $profile->name }}"
                                     class="object-cover w-full h-full">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($profile->name ?? 'User') }}&background=random&size=512"
                                     alt="{{ $profile->name }}"
                                     class="object-cover w-full h-full">
                            @endif
                        </div>

                        {{-- Badge Skill Utama - Dihilangkan di layar paling kecil agar tidak menumpuk --}}
                        <div class="hidden sm:flex absolute -bottom-4 -left-4 md:-bottom-6 md:-left-6 bg-white p-2 md:p-4 rounded-lg sm:rounded-xl shadow-lg border border-slate-100 items-center gap-1 sm:gap-2 md:gap-3 animate-bounce" style="animation-duration: 3s;">
                            <div class="bg-indigo-100 p-1 sm:p-1.5 md:p-2 rounded-md sm:rounded-lg text-indigo-600">
                                <i class="ph ph-code text-sm sm:text-xl md:text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[8px] sm:text-[10px] md:text-xs text-slate-500">Skill Utama</p>
                                <p class="text-[10px] sm:text-sm md:text-base font-bold text-slate-800">Laravel & PHP</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================================================================
         LAYANAN SECTION
         ================================================================ --}}
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto mb-10 md:mb-16" data-aos="fade-down">
                <h2 class="text-xs md:text-sm font-bold text-indigo-600 tracking-wider uppercase mb-2">Layanan</h2>
                <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900">Apa yang Bisa Saya Bantu?</h3>
                <p class="mt-3 md:mt-4 text-sm md:text-base text-slate-600">Solusi teknis end-to-end untuk kebutuhan bisnis Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                @foreach($services as $index => $service)
                <div data-aos="fade-up"
                     data-aos-delay="{{ $index * 100 }}"
                     data-aos-duration="800">

                    <div class="p-6 md:p-8 rounded-2xl bg-slate-50 border border-slate-100
                                hover:bg-white hover:shadow-xl hover:border-indigo-100
                                hover:-translate-y-2
                                transition-all duration-300 ease-out
                                group h-full cursor-pointer">

                        <div class="w-12 h-12 md:w-14 md:h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-indigo-600 text-2xl md:text-3xl mb-4 md:mb-6
                                    group-hover:bg-indigo-600 group-hover:text-white
                                    transition-all duration-300">
                            <i class="ph {{ $service->icon }}"></i>
                        </div>
                        <h4 class="text-lg md:text-xl font-bold text-slate-900 mb-2 md:mb-3">{{ $service->title }}</h4>
                        <p class="text-sm md:text-base text-slate-600 leading-relaxed">{{ $service->description }}</p>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         SKILLS SECTION
         ================================================================ --}}
    <section id="skills" class="py-16 md:py-24 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-10 md:gap-16">

                <div class="md:w-1/3" data-aos="fade-right">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 md:mb-6">
                        Technical <br class="hidden md:block"><span class="text-indigo-400">Expertise</span>
                    </h3>
                    <p class="text-sm md:text-base text-slate-400 leading-relaxed mb-6 md:mb-8">
                        Saya terus memperbarui skill set saya mengikuti standar industri modern.
                        Fokus utama saya adalah performa, keamanan, dan skalabilitas.
                    </p>

                    @if($profile->cv_link)
                    <a href="{{ $profile->cv_link }}" target="_blank"
                       class="text-sm md:text-base text-indigo-400 font-semibold hover:text-white transition-colors duration-300 flex items-center gap-2 group">
                        Download Resume Lengkap
                        <i class="ph ph-download-simple group-hover:translate-y-0.5 transition-transform duration-300"></i>
                    </a>
                    @else
                    <span class="text-slate-500 italic text-xs md:text-sm">Link CV belum tersedia</span>
                    @endif
                </div>

                <div class="md:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8"
                     data-aos="fade-left"
                     data-aos-delay="200">

                    @foreach($skills as $category => $items)
                    <div>
                        <h4 class="text-base md:text-lg font-bold text-white mb-3 md:mb-4 border-b border-slate-700 pb-2">{{ $category }}</h4>
                        <div class="space-y-3 md:space-y-4">
                            @foreach($items as $skill)
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-xs md:text-sm font-medium text-slate-300 flex items-center gap-2">
                                        <i class="ph {{ $skill->icon }}"></i> {{ $skill->name }}
                                    </span>
                                    <span class="text-[10px] md:text-xs text-slate-500">{{ $skill->proficiency }}%</span>
                                </div>
                                <div class="w-full bg-slate-800 rounded-full h-1.5 md:h-2">
                                    <div class="bg-indigo-500 h-1.5 md:h-2 rounded-full transition-all duration-1000"
                                         style="width: {{ $skill->proficiency }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         PENGALAMAN SECTION
         ================================================================ --}}
    <section id="experience" class="py-16 md:py-24 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-10 md:mb-16" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">Pengalaman Profesional</h2>
            </div>

            <div class="space-y-10 md:space-y-12">

                {{-- Riwayat Pekerjaan --}}
                @if($work_experiences->count() > 0)
                <div data-aos="fade-up">
                    <h3 class="text-lg md:text-xl font-bold text-indigo-600 mb-4 md:mb-6 flex items-center gap-2">
                        <i class="ph ph-briefcase"></i> Riwayat Pekerjaan
                    </h3>
                    <div class="relative border-l-2 border-slate-200 ml-2 md:ml-3 space-y-8 md:space-y-10">
                        @foreach($work_experiences as $exp)
                        <div class="relative pl-6 md:pl-8" data-aos="fade-up" data-aos-offset="100">
                            <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-4 border-indigo-600"></span>
                            <span class="text-[10px] md:text-xs font-bold text-indigo-600 uppercase tracking-wider bg-indigo-50 px-2 py-1 rounded mb-2 inline-block">
                                {{ $exp->period }}
                            </span>
                            <h4 class="text-base md:text-lg font-bold text-slate-900">{{ $exp->role }}</h4>
                            <div class="text-slate-500 font-medium text-xs md:text-sm mb-2">{{ $exp->company }}</div>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">{{ $exp->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Pengalaman Organisasi --}}
                @if($organizations->count() > 0)
                <div data-aos="fade-up">
                    <h3 class="text-lg md:text-xl font-bold text-purple-600 mb-4 md:mb-6 flex items-center gap-2">
                        <i class="ph ph-users-three"></i> Pengalaman Organisasi
                    </h3>
                    <div class="relative border-l-2 border-slate-200 ml-2 md:ml-3 space-y-8 md:space-y-10">
                        @foreach($organizations as $org)
                        <div class="relative pl-6 md:pl-8" data-aos="fade-up" data-aos-offset="100">
                            <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-4 border-purple-600"></span>
                            <span class="text-[10px] md:text-xs font-bold text-purple-600 uppercase tracking-wider bg-purple-50 px-2 py-1 rounded mb-2 inline-block">
                                {{ $org->period }}
                            </span>
                            <h4 class="text-base md:text-lg font-bold text-slate-900">{{ $org->role }}</h4>
                            <div class="text-slate-500 font-medium text-xs md:text-sm mb-2">{{ $org->company }}</div>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">{{ $org->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Pendidikan --}}
                @if($educations->count() > 0)
                <div data-aos="fade-up">
                    <h3 class="text-lg md:text-xl font-bold text-emerald-600 mb-4 md:mb-6 flex items-center gap-2">
                        <i class="ph ph-graduation-cap"></i> Pendidikan
                    </h3>
                    <div class="relative border-l-2 border-slate-200 ml-2 md:ml-3 space-y-8 md:space-y-10">
                        @foreach($educations as $edu)
                        <div class="relative pl-6 md:pl-8" data-aos="fade-up" data-aos-offset="100">
                            <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-4 border-emerald-500"></span>
                            <span class="text-[10px] md:text-xs font-bold text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2 py-1 rounded mb-2 inline-block">
                                {{ $edu->period }}
                            </span>
                            <h4 class="text-base md:text-lg font-bold text-slate-900">{{ $edu->role }}</h4>
                            <div class="text-slate-500 font-medium text-xs md:text-sm mb-2">{{ $edu->company }}</div>
                            <p class="text-xs md:text-sm text-slate-600 leading-relaxed">{{ $edu->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </section>

    {{-- ================================================================
         PROYEK / PORTOFOLIO SECTION
         ================================================================ --}}
    <section id="projects" class="py-16 md:py-24 bg-white" style="overflow-x: clip;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-8 md:mb-12 gap-4" data-aos="fade-down">
                <div class="text-center md:text-left">
                    <h2 class="text-xs md:text-sm font-bold text-indigo-600 tracking-wider uppercase mb-1 md:mb-2">Portofolio</h2>
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900">Karya Terbaru</h3>
                </div>
                <a href="{{ $profile->github_link ?? '#' }}" target="_blank"
                   class="px-5 py-2 md:px-6 border border-slate-300 rounded-lg text-sm md:text-base text-slate-600 font-medium hover:bg-slate-50 hover:border-indigo-400 hover:text-indigo-600 transition-all duration-300">
                    Lihat Semua di GitHub
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($projects as $index => $project)

                <div data-aos="fade-up"
                     data-aos-delay="{{ ($index % 3) * 150 }}"
                     data-aos-duration="800">

                    <div class="group relative bg-white rounded-2xl border border-slate-100 overflow-hidden
                                shadow-sm
                                hover:shadow-2xl hover:shadow-indigo-500/10
                                hover:-translate-y-2
                                transition-all duration-300 ease-out
                                h-full">

                        {{-- Thumbnail --}}
                        <div class="h-48 md:h-56 bg-slate-200 overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent
                                        opacity-0 group-hover:opacity-100
                                        transition-all duration-300 ease-out
                                        z-10 flex items-end p-4 md:p-6">
                                <a href="{{ $project->link_url }}" target="_blank"
                                   class="text-white text-sm md:text-base font-bold flex items-center gap-2 hover:underline">
                                    Lihat Project <i class="ph ph-arrow-up-right"></i>
                                </a>
                            </div>

                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}"
                                     alt="{{ $project->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                    <i class="ph ph-image text-4xl"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Konten Kartu --}}
                        <div class="p-5 md:p-6">
                            <div class="text-[10px] md:text-xs font-bold text-indigo-600 mb-1 md:mb-2 uppercase tracking-wide">
                                {{ $project->category }}
                            </div>
                            <h4 class="text-lg md:text-xl font-bold text-slate-900 mb-2 md:mb-3 group-hover:text-indigo-600 transition-colors duration-300">
                                {{ $project->title }}
                            </h4>
                            <p class="text-slate-500 text-xs md:text-sm line-clamp-3 mb-2 md:mb-4">
                                {{ $project->description }}
                            </p>
                        </div>

                    </div>
                </div>

                @empty
                <div class="col-span-1 md:col-span-3 text-center py-16 md:py-20" data-aos="fade-in">
                    <p class="text-sm md:text-base text-slate-500">Belum ada proyek yang ditampilkan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ================================================================
         KONTAK SECTION
         ================================================================ --}}
    <section id="contact" class="py-16 md:py-24 bg-indigo-600 relative" style="overflow-x: clip;">
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 relative z-10">

            <div class="text-center mb-10 md:mb-12" data-aos="zoom-in">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-3 md:mb-4">Hubungi Saya</h2>
                <p class="text-sm md:text-base text-indigo-100">Silakan kirim pesan untuk diskusi proyek atau sekadar menyapa.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 md:mb-8 bg-green-500 text-white px-4 py-3 md:px-6 md:py-4 rounded-xl shadow-lg flex items-center gap-3 animate-bounce">
                    <i class="ph-bold ph-check-circle text-xl md:text-2xl"></i>
                    <div>
                        <p class="font-bold text-sm md:text-base">Berhasil Terkirim!</p>
                        <p class="text-xs md:text-sm text-green-100">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Form --}}
            <div data-aos="fade-up" data-aos-duration="1000">
                <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-10">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5 md:space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                            <div class="space-y-1.5 md:space-y-2">
                                <label class="text-xs md:text-sm font-bold text-slate-700 uppercase">Nama Lengkap</label>
                                <input type="text" name="name"
                                       class="w-full px-3 py-2.5 md:px-4 md:py-3 bg-slate-50 border border-slate-200 rounded-xl
                                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm md:text-base
                                              transition-all duration-200"
                                       placeholder="John Doe" required>
                            </div>
                            <div class="space-y-1.5 md:space-y-2">
                                <label class="text-xs md:text-sm font-bold text-slate-700 uppercase">Alamat Email</label>
                                <input type="email" name="email"
                                       class="w-full px-3 py-2.5 md:px-4 md:py-3 bg-slate-50 border border-slate-200 rounded-xl
                                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm md:text-base
                                              transition-all duration-200"
                                       placeholder="email@anda.com" required>
                            </div>
                        </div>

                        <div class="space-y-1.5 md:space-y-2">
                            <label class="text-xs md:text-sm font-bold text-slate-700 uppercase">Pesan Anda</label>
                            <textarea name="message" rows="4" md:rows="5"
                                      class="w-full px-3 py-2.5 md:px-4 md:py-3 bg-slate-50 border border-slate-200 rounded-xl
                                             focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm md:text-base
                                             transition-all duration-200 resize-none"
                                      placeholder="Tuliskan detail proyek atau pesan Anda di sini..."
                                      required></textarea>
                        </div>

                        <button type="submit"
                                class="w-full bg-indigo-600 text-white text-sm md:text-base font-bold py-3 md:py-4 rounded-xl
                                       hover:bg-indigo-700 hover:-translate-y-0.5
                                       transition-all duration-300
                                       shadow-lg shadow-indigo-200
                                       flex items-center justify-center gap-2">
                            <i class="ph-bold ph-paper-plane-right text-lg md:text-xl"></i> Kirim Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>

            {{-- Info Kontak --}}
            <div class="mt-10 md:mt-12 flex flex-col md:flex-row justify-center gap-4 md:gap-8 text-center md:text-left text-indigo-100">
                <div class="flex items-center justify-center md:justify-start gap-2 md:gap-3"
                     data-aos="fade-right"
                     data-aos-delay="200">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-white/10 rounded-full flex items-center justify-center">
                        <i class="ph-fill ph-envelope-simple text-lg md:text-xl"></i>
                    </div>
                    <span class="text-sm md:text-base">{{ $profile->email }}</span>
                </div>
                <div class="flex items-center justify-center md:justify-start gap-2 md:gap-3"
                     data-aos="fade-left"
                     data-aos-delay="400">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-white/10 rounded-full flex items-center justify-center">
                        <i class="ph-fill ph-linkedin-logo text-lg md:text-xl"></i>
                    </div>
                    <span class="text-sm md:text-base">Rian Pramudya Amanda</span>
                </div>
            </div>

        </div>
    </section>

@endsection