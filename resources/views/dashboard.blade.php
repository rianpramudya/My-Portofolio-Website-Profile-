@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard & Profil')

@section('content')

    {{-- ================================================================
         STAT CARDS
         ================================================================ --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

        {{-- Card: Total Proyek --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6
                    shadow-sm hover:shadow-md hover:border-indigo-200
                    transition-all duration-200 group cursor-default">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">
                        Total Proyek
                    </p>
                    <p class="text-4xl font-bold text-slate-900 leading-none">
                        {{ $projectCount }}
                    </p>
                    <div class="mt-3 inline-flex items-center gap-1
                                text-xs font-medium text-emerald-600
                                bg-emerald-50 px-2 py-1 rounded-full">
                        <i class="ph ph-trend-up text-sm"></i>
                        <span>Aktif ditampilkan</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-100
                            flex items-center justify-center text-indigo-500
                            group-hover:bg-indigo-600 group-hover:text-white
                            group-hover:border-indigo-600
                            group-hover:scale-110
                            transition-all duration-200 shadow-sm flex-shrink-0">
                    <i class="ph-fill ph-briefcase text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Card: Pengalaman --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6
                    shadow-sm hover:shadow-md hover:border-violet-200
                    transition-all duration-200 group cursor-default">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">
                        Pengalaman
                    </p>
                    <p class="text-4xl font-bold text-slate-900 leading-none">
                        {{ $experienceCount }}
                    </p>
                    <div class="mt-3 inline-flex items-center gap-1
                                text-xs font-medium text-violet-600
                                bg-violet-50 px-2 py-1 rounded-full">
                        <i class="ph ph-graduation-cap text-sm"></i>
                        <span>Kerja & Organisasi</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-violet-50 border border-violet-100
                            flex items-center justify-center text-violet-500
                            group-hover:bg-violet-600 group-hover:text-white
                            group-hover:border-violet-600
                            group-hover:scale-110
                            transition-all duration-200 shadow-sm flex-shrink-0">
                    <i class="ph-fill ph-graduation-cap text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Card: Status Website --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6
                    shadow-sm hover:shadow-md hover:border-emerald-200
                    transition-all duration-200 group cursor-default">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-2">
                        Status Website
                    </p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse flex-shrink-0"></span>
                        <span class="text-xl font-bold text-emerald-600">Online</span>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('home') }}" target="_blank"
                           class="inline-flex items-center gap-1 text-xs font-medium
                                  text-slate-500 hover:text-indigo-600
                                  bg-slate-50 hover:bg-indigo-50
                                  px-2 py-1 rounded-full
                                  border border-slate-200 hover:border-indigo-200
                                  transition-all duration-150">
                            <i class="ph ph-arrow-square-out text-sm"></i>
                            <span>Lihat Website</span>
                        </a>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100
                            flex items-center justify-center text-emerald-500
                            group-hover:bg-emerald-600 group-hover:text-white
                            group-hover:border-emerald-600
                            group-hover:scale-110
                            transition-all duration-200 shadow-sm flex-shrink-0">
                    <i class="ph-fill ph-globe text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- ================================================================
         MAIN GRID: Form Profil + Sidebar Avatar
         ================================================================ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- ── Form Edit Profil ── --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="px-8 py-5 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                        <i class="ph ph-user-circle text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Informasi Profil</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Data ini tampil di halaman publik portofolio.</p>
                    </div>
                </div>

                {{-- Form Body --}}
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
                      class="p-8 space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Grup: Identitas --}}
                    <fieldset>
                        <legend class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4
                                       flex items-center gap-2">
                            <i class="ph ph-identification-card text-base text-slate-300"></i>
                            Identitas
                        </legend>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700">
                                    Nama Lengkap
                                </label>
                                <input type="text" name="name" value="{{ $profile->name }}"
                                       placeholder="Contoh: Rian Pramudya Amanda"
                                       class="form-input">
                                @error('name')
                                    <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                                        <i class="ph ph-warning-circle"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700">
                                    Headline / Jabatan
                                </label>
                                <input type="text" name="headline" value="{{ $profile->headline }}"
                                       placeholder="Contoh: Full Stack Developer"
                                       class="form-input">
                                @error('headline')
                                    <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                                        <i class="ph ph-warning-circle"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Grup: Bio --}}
                    <fieldset>
                        <legend class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4
                                       flex items-center gap-2">
                            <i class="ph ph-text-align-left text-base text-slate-300"></i>
                            Bio & Deskripsi
                        </legend>
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-slate-700">
                                Tentang Saya
                            </label>
                            <textarea name="about_text" rows="4"
                                      placeholder="Ceritakan tentang diri Anda secara singkat dan menarik..."
                                      class="form-input resize-none leading-relaxed">{{ $profile->about_text }}</textarea>
                            @error('about_text')
                                <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                                    <i class="ph ph-warning-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </fieldset>

                    {{-- Grup: Kontak --}}
                    <fieldset>
                        <legend class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4
                                       flex items-center gap-2">
                            <i class="ph ph-envelope-simple text-base text-slate-300"></i>
                            Kontak & Dokumen
                        </legend>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700">
                                    Email Publik
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                        <i class="ph ph-envelope text-base"></i>
                                    </span>
                                    <input type="email" name="email" value="{{ $profile->email }}"
                                           placeholder="email@contoh.com"
                                           class="form-input pl-9">
                                </div>
                                @error('email')
                                    <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                                        <i class="ph ph-warning-circle"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700">
                                    Link CV
                                    <span class="font-normal text-slate-400 text-xs ml-1">(Google Drive / PDF)</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                        <i class="ph ph-link text-base"></i>
                                    </span>
                                    <input type="url" name="cv_link" value="{{ $profile->cv_link }}"
                                           placeholder="https://drive.google.com/..."
                                           class="form-input pl-9">
                                </div>
                                @error('cv_link')
                                    <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                                        <i class="ph ph-warning-circle"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Grup: Social Links --}}
                    <fieldset>
                        <legend class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4
                                       flex items-center gap-2">
                            <i class="ph ph-share-network text-base text-slate-300"></i>
                            Social Links
                        </legend>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700 flex items-center gap-1.5">
                                    <i class="ph-fill ph-github-logo text-slate-500"></i> GitHub URL
                                </label>
                                <input type="url" name="github_link" value="{{ $profile->github_link }}"
                                       placeholder="https://github.com/username"
                                       class="form-input">
                                @error('github_link')
                                    <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                                        <i class="ph ph-warning-circle"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-sm font-semibold text-slate-700 flex items-center gap-1.5">
                                    <i class="ph-fill ph-linkedin-logo text-blue-500"></i> LinkedIn URL
                                </label>
                                <input type="url" name="linkedin_link" value="{{ $profile->linkedin_link }}"
                                       placeholder="https://linkedin.com/in/username"
                                       class="form-input">
                                @error('linkedin_link')
                                    <p class="text-xs text-red-500 flex items-center gap-1 mt-1">
                                        <i class="ph ph-warning-circle"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Submit Button --}}
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                        <p class="text-xs text-slate-400">
                            <i class="ph ph-clock text-sm"></i>
                            Terakhir diubah: {{ $profile->updated_at ? $profile->updated_at->diffForHumans() : 'Belum pernah' }}
                        </p>
                        <button type="submit"
                                class="flex items-center gap-2
                                       bg-indigo-600 text-white
                                       px-6 py-2.5 rounded-xl
                                       text-sm font-semibold
                                       hover:bg-indigo-700
                                       active:scale-95
                                       transition-all duration-150
                                       shadow-lg shadow-indigo-500/25
                                       hover:shadow-indigo-500/40">
                            <i class="ph-bold ph-floppy-disk text-base"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>

        {{-- ── Sidebar Kanan ── --}}
        <div class="lg:col-span-1 space-y-5">

            {{-- Card: Foto Profil --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                    <i class="ph ph-image-square text-base text-slate-400"></i>
                    <h3 class="text-sm font-bold text-slate-900">Foto Profil</h3>
                </div>
                <div class="p-6">
                    {{-- Avatar Preview --}}
                    <div class="relative w-32 h-32 mx-auto mb-5">
                        <div class="w-full h-full rounded-2xl overflow-hidden
                                    border-2 border-slate-100 shadow-md">
                            @if($profile->avatar)
                                <img id="avatar-preview"
                                     src="{{ asset('storage/' . $profile->avatar) }}"
                                     alt="Avatar"
                                     class="w-full h-full object-cover">
                            @else
                                <div id="avatar-placeholder"
                                     class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200
                                            flex items-center justify-center text-slate-400">
                                    <i class="ph ph-user text-4xl"></i>
                                </div>
                                <img id="avatar-preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                            @endif
                        </div>
                        {{-- Badge online --}}
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500
                                    rounded-full border-2 border-white shadow-sm
                                    flex items-center justify-center">
                            <i class="ph-fill ph-check text-white text-[10px]"></i>
                        </div>
                    </div>

                    {{-- Upload Form --}}
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
                          class="space-y-4">
                        @csrf
                        @method('PUT')
                        {{-- Field tersembunyi agar validasi name tidak gagal --}}
                        <input type="hidden" name="name" value="{{ $profile->name }}">

                        {{-- Drop Zone / File Input --}}
                        <label for="avatar-input"
                               class="flex flex-col items-center gap-2 p-4 rounded-xl
                                      border-2 border-dashed border-slate-200
                                      hover:border-indigo-400 hover:bg-indigo-50/50
                                      cursor-pointer transition-all duration-200 group">
                            <i class="ph ph-upload-simple text-2xl text-slate-400
                                      group-hover:text-indigo-500 transition-colors duration-200"></i>
                            <div class="text-center">
                                <span class="text-sm font-medium text-slate-600
                                             group-hover:text-indigo-600 transition-colors duration-200">
                                    Pilih Foto Baru
                                </span>
                                <p class="text-xs text-slate-400 mt-0.5">JPG, PNG, WebP · Max 2MB</p>
                            </div>
                        </label>
                        <input id="avatar-input" type="file" name="avatar"
                               accept="image/*" class="sr-only">

                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2
                                       py-2.5 text-sm font-semibold
                                       bg-slate-900 text-white rounded-xl
                                       hover:bg-indigo-600
                                       active:scale-95
                                       transition-all duration-200
                                       shadow-sm">
                            <i class="ph ph-arrow-up text-base"></i>
                            Upload Foto
                        </button>
                    </form>
                </div>
            </div>

            {{-- Card: Quick Links --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
                    <i class="ph ph-lightning text-base text-slate-400"></i>
                    <h3 class="text-sm font-bold text-slate-900">Aksi Cepat</h3>
                </div>
                <div class="p-4 space-y-1.5">
                    @php
                        $quickLinks = [
                            ['href' => 'admin.projects.create',    'icon' => 'ph-plus-circle',    'label' => 'Tambah Proyek Baru',    'color' => 'text-indigo-600 bg-indigo-50 hover:bg-indigo-100'],
                            ['href' => 'admin.experiences.create', 'icon' => 'ph-plus-circle',    'label' => 'Tambah Pengalaman',     'color' => 'text-violet-600 bg-violet-50 hover:bg-violet-100'],
                            ['href' => 'admin.services.create',    'icon' => 'ph-plus-circle',    'label' => 'Tambah Layanan',        'color' => 'text-blue-600 bg-blue-50 hover:bg-blue-100'],
                            ['href' => 'admin.contacts.index',     'icon' => 'ph-envelope-simple','label' => 'Lihat Pesan Masuk',     'color' => 'text-emerald-600 bg-emerald-50 hover:bg-emerald-100'],
                        ];
                    @endphp

                    @foreach($quickLinks as $link)
                    <a href="{{ route($link['href']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium
                              {{ $link['color'] }} transition-colors duration-150
                              border border-transparent hover:border-current/10">
                        <i class="ph {{ $link['icon'] }} text-base flex-shrink-0"></i>
                        {{ $link['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- ================================================================
         SCRIPTS — Avatar Preview
         ================================================================ --}}
    <script>
        /* ─────────────────────────────────────────────────────────────
         * AVATAR LIVE PREVIEW
         * Saat user memilih file, gambar langsung muncul
         * tanpa perlu upload dulu.
         * ───────────────────────────────────────────────────────────── */
        const avatarInput       = document.getElementById('avatar-input');
        const avatarPreview     = document.getElementById('avatar-preview');
        const avatarPlaceholder = document.getElementById('avatar-placeholder');

        if (avatarInput) {
            avatarInput.addEventListener('change', function () {
                const file = this.files[0];
                if (!file || !file.type.startsWith('image/')) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    if (avatarPreview) {
                        avatarPreview.src = e.target.result;
                        avatarPreview.classList.remove('hidden');
                    }
                    if (avatarPlaceholder) {
                        avatarPlaceholder.classList.add('hidden');
                    }
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

@endsection