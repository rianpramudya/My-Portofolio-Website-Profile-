@extends('layouts.app')

{{-- Judul Halaman Mengambil Nama dari Database --}}
@section('title', ($profile->name ?? 'Portfolio') . ' - ' . ($profile->headline ?? 'Web Developer'))

@section('content')
    <section id="home" class="relative pt-32 pb-24 overflow-hidden bg-slate-50">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-blue-100 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-3/5 space-y-8 text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white border border-slate-200 shadow-sm text-sm font-medium text-slate-600 mb-4">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-ping"></span>
                        Available for Freelance & Hiring
                    </div>
                    
                    {{-- HEADLINE DINAMIS --}}
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        @php
                            $headline = $profile->headline ?? 'Web Developer';
                            $words = explode(' ', $headline);
                            $firstWord = array_shift($words);
                            $restWords = implode(' ', $words);
                        @endphp
                        
                        @if($firstWord)
                            {{ $firstWord }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">{{ $restWords }}</span>
                        @else
                            Web Developer
                        @endif
                    </h1>

                    {{-- ABOUT TEXT DINAMIS --}}
                    <p class="text-xl text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        {{ $profile->about_text }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                        <a href="#projects" class="px-8 py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition shadow-xl shadow-slate-900/20 flex items-center justify-center gap-2">
                            Lihat Karya Saya <i class="ph ph-arrow-down"></i>
                        </a>
                        {{-- EMAIL DINAMIS --}}
                        <a href="mailto:{{ $profile->email }}" class="px-8 py-4 bg-white text-slate-900 border border-slate-200 rounded-xl font-bold hover:border-indigo-600 hover:text-indigo-600 transition flex items-center justify-center gap-2">
                            <i class="ph ph-chat-circle-text text-xl"></i> Hubungi Saya
                        </a>
                    </div>
                    
                    <div class="pt-8 flex gap-8 justify-center lg:justify-start border-t border-slate-200 mt-8">
                        <div>
                            <span class="block text-3xl font-bold text-slate-900">{{ $experiences->count() }}+</span>
                            <span class="text-sm text-slate-500">Posisi Kerja</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-bold text-slate-900">{{ $projects->count() }}+</span>
                            <span class="text-sm text-slate-500">Proyek Selesai</span>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-2/5 flex justify-center" data-aos="zoom-in" data-aos-duration="1200" data-aos-delay="200">
                    <div class="relative w-80 h-80 md:w-96 md:h-96">
                        <div class="absolute inset-0 bg-gradient-to-tr from-indigo-600 to-blue-500 rounded-[2rem] rotate-6 opacity-20"></div>
                        <div class="absolute inset-0 bg-white rounded-[2rem] shadow-2xl overflow-hidden border-4 border-white rotate-0 hover:-rotate-2 transition duration-500">
                            @if($profile->avatar)
                                <img src="{{ asset('storage/' . $profile->avatar) }}" alt="{{ $profile->name }}" class="object-cover w-full h-full">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($profile->name ?? 'User') }}&background=random&size=512" alt="{{ $profile->name }}" class="object-cover w-full h-full">
                            @endif
                        </div>
                        
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-lg border border-slate-100 flex items-center gap-3 animate-bounce" style="animation-duration: 3s;">
                            <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600"><i class="ph ph-code text-2xl"></i></div>
                            <div>
                                <p class="text-xs text-slate-500">Skill Utama</p>
                                <p class="font-bold text-slate-800">Laravel & PHP</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-down">
                <h2 class="text-sm font-bold text-indigo-600 tracking-wider uppercase mb-2">Layanan</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-slate-900">Apa yang Bisa Saya Bantu?</h3>
                <p class="mt-4 text-slate-600">Solusi teknis end-to-end untuk kebutuhan bisnis Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($services as $index => $service)
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-xl hover:border-indigo-100 transition duration-300 group" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}">
                    <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center text-indigo-600 text-3xl mb-6 group-hover:bg-indigo-600 group-hover:text-white transition">
                        <i class="ph {{ $service->icon }}"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">{{ $service->title }}</h4>
                    <p class="text-slate-600 leading-relaxed">{{ $service->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="skills" class="py-24 bg-slate-900 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-16">
                <div class="md:w-1/3" data-aos="fade-right">
                    <h3 class="text-3xl font-bold mb-6">Technical <br><span class="text-indigo-400">Expertise</span></h3>
                    <p class="text-slate-400 leading-relaxed mb-8">
                        Saya terus memperbarui skill set saya mengikuti standar industri modern. Fokus utama saya adalah performa, keamanan, dan skalabilitas.
                    </p>
                    
                    @if($profile->cv_link)
                    <a href="{{ $profile->cv_link }}" target="_blank" class="text-indigo-400 font-semibold hover:text-white transition flex items-center gap-2">
                        Download Resume Lengkap <i class="ph ph-download-simple"></i>
                    </a>
                    @else
                    <span class="text-slate-500 italic text-sm">Link CV belum tersedia</span>
                    @endif
                </div>
                <div class="md:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-8" data-aos="fade-left" data-aos-delay="200">
                    @foreach($skills as $category => $items)
                    <div>
                        <h4 class="text-lg font-bold text-white mb-4 border-b border-slate-700 pb-2">{{ $category }}</h4>
                        <div class="space-y-4">
                            @foreach($items as $skill)
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-sm font-medium text-slate-300 flex items-center gap-2">
                                        <i class="ph {{ $skill->icon }}"></i> {{ $skill->name }}
                                    </span>
                                    <span class="text-xs text-slate-500">{{ $skill->proficiency }}%</span>
                                </div>
                                <div class="w-full bg-slate-800 rounded-full h-2 overflow-hidden">
                                    <div class="bg-indigo-500 h-2 rounded-full transition-all duration-1000 ease-out" style="width: {{ $skill->proficiency }}%"></div>
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

    <section id="experience" class="py-24 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-slate-900">Pengalaman Profesional</h2>
            </div>

            <div class="space-y-12">
                @if($work_experiences->count() > 0)
                <div data-aos="fade-up">
                    <h3 class="text-xl font-bold text-indigo-600 mb-6 flex items-center gap-2">
                        <i class="ph ph-briefcase"></i> Riwayat Pekerjaan
                    </h3>
                    <div class="relative border-l-2 border-slate-200 ml-3 space-y-10">
                        @foreach($work_experiences as $exp)
                        <div class="relative pl-8" data-aos="fade-up" data-aos-offset="100">
                            <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-4 border-indigo-600"></span>
                            <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider bg-indigo-50 px-2 py-1 rounded mb-2 inline-block">{{ $exp->period }}</span>
                            <h4 class="text-lg font-bold text-slate-900">{{ $exp->role }}</h4>
                            <div class="text-slate-500 font-medium text-sm mb-2">{{ $exp->company }}</div>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $exp->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($organizations->count() > 0)
                <div data-aos="fade-up">
                    <h3 class="text-xl font-bold text-purple-600 mb-6 flex items-center gap-2">
                        <i class="ph ph-users-three"></i> Pengalaman Organisasi
                    </h3>
                    <div class="relative border-l-2 border-slate-200 ml-3 space-y-10">
                        @foreach($organizations as $org)
                        <div class="relative pl-8" data-aos="fade-up" data-aos-offset="100">
                            <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-4 border-purple-600"></span>
                            <span class="text-xs font-bold text-purple-600 uppercase tracking-wider bg-purple-50 px-2 py-1 rounded mb-2 inline-block">{{ $org->period }}</span>
                            <h4 class="text-lg font-bold text-slate-900">{{ $org->role }}</h4>
                            <div class="text-slate-500 font-medium text-sm mb-2">{{ $org->company }}</div>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $org->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($educations->count() > 0)
                <div data-aos="fade-up">
                    <h3 class="text-xl font-bold text-emerald-600 mb-6 flex items-center gap-2">
                        <i class="ph ph-graduation-cap"></i> Pendidikan
                    </h3>
                    <div class="relative border-l-2 border-slate-200 ml-3 space-y-10">
                        @foreach($educations as $edu)
                        <div class="relative pl-8" data-aos="fade-up" data-aos-offset="100">
                            <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white border-4 border-emerald-500"></span>
                            <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2 py-1 rounded mb-2 inline-block">{{ $edu->period }}</span>
                            <h4 class="text-lg font-bold text-slate-900">{{ $edu->role }}</h4>
                            <div class="text-slate-500 font-medium text-sm mb-2">{{ $edu->company }}</div>
                            <p class="text-slate-600 text-sm leading-relaxed">{{ $edu->description }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section id="projects" class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4" data-aos="fade-down">
                <div>
                    <h2 class="text-sm font-bold text-indigo-600 tracking-wider uppercase mb-2">Portofolio</h2>
                    <h3 class="text-3xl md:text-4xl font-bold text-slate-900">Karya Terbaru</h3>
                </div>
                <a href="{{ $profile->github_link ?? '#' }}" target="_blank" class="px-6 py-2 border border-slate-300 rounded-lg text-slate-600 font-medium hover:bg-slate-50 transition">Lihat Semua di GitHub</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $index => $project)
                <div class="group relative bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 hover:-translate-y-2"
                     data-aos="fade-up" 
                     data-aos-delay="{{ ($index % 3) * 150 }}">
                    <div class="h-56 bg-slate-200 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 z-10 flex items-end p-6">
                            <a href="{{ $project->link_url }}" target="_blank" class="text-white font-bold flex items-center gap-2 hover:underline">
                                Lihat Project <i class="ph ph-arrow-up-right"></i>
                            </a>
                        </div>
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                                <i class="ph ph-image text-4xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="text-xs font-bold text-indigo-600 mb-2 uppercase tracking-wide">{{ $project->category }}</div>
                        <h4 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition">{{ $project->title }}</h4>
                        <p class="text-slate-500 text-sm line-clamp-3 mb-4">{{ $project->description }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-20" data-aos="fade-in">
                    <p class="text-slate-500">Belum ada proyek yang ditampilkan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact" class="py-24 bg-indigo-600 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10">
            
            <div class="text-center mb-12" data-aos="zoom-in">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Hubungi Saya</h2>
                <p class="text-indigo-100">Silakan kirim pesan untuk diskusi proyek atau sekadar menyapa.</p>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-3 animate-bounce">
                    <i class="ph-bold ph-check-circle text-2xl"></i>
                    <div>
                        <p class="font-bold">Berhasil Terkirim!</p>
                        <p class="text-sm text-green-100">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-10" data-aos="fade-up" data-aos-duration="1000">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 uppercase">Nama Lengkap</label>
                            <input type="text" name="name" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="John Doe" required>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 uppercase">Alamat Email</label>
                            <input type="email" name="email" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="email@anda.com" required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 uppercase">Pesan Anda</label>
                        <textarea name="message" rows="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none" placeholder="Tuliskan detail proyek atau pesan Anda di sini..." required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
                        <i class="ph-bold ph-paper-plane-right text-xl"></i> Kirim Pesan Sekarang
                    </button>
                </form>
            </div>

            <div class="mt-12 flex flex-col md:flex-row justify-center gap-8 text-center md:text-left text-indigo-100">
                <div class="flex items-center justify-center gap-3" data-aos="fade-right" data-aos-delay="200">
                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                        <i class="ph-fill ph-envelope-simple text-xl"></i>
                    </div>
                    <span>{{ $profile->email }}</span>
                </div>
                <div class="flex items-center justify-center gap-3" data-aos="fade-left" data-aos-delay="400">
                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center">
                        <i class="ph-fill ph-linkedin-logo text-xl"></i>
                    </div>
                    <span>{{ $profile->name }}</span>
                </div>
            </div>

        </div>
    </section>
@endsection