@extends('layouts.admin')

@section('header', 'Dashboard & Profil')

@section('content')
    <div class="flex flex-col gap-8">
        
        <!-- 1. SECTION STATISTIK (Baris Atas) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Total Proyek -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl">
                    <i class="ph-fill ph-briefcase"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Proyek</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $projectCount }}</p>
                </div>
            </div>

            <!-- Card Pengalaman -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center gap-4">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-2xl">
                    <i class="ph-fill ph-medal"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pengalaman</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $experienceCount }}</p>
                </div>
            </div>

            <!-- Card Status -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-2xl">
                        <i class="ph-fill ph-globe"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Website</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-sm font-bold text-emerald-700">Online</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('home') }}" target="_blank" class="px-3 py-1.5 text-xs font-bold text-slate-500 border border-slate-200 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 transition">
                    Lihat Web <i class="ph-bold ph-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- 2. SECTION EDIT PROFIL (Baris Bawah - Grid Terpisah) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- KOLOM KIRI: Form Edit (Mengambil 2/3 Lebar) -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 flex flex-col h-fit">
                <!-- Header Card -->
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 rounded-t-2xl">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="ph-duotone ph-pencil-simple-line text-indigo-500 text-lg"></i> Edit Informasi Profil
                    </h3>
                </div>

                <div class="p-8">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Baris 1: Identitas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase">Nama Lengkap</label>
                                <div class="relative group">
                                    <i class="ph ph-user absolute left-3 top-3 text-slate-400 text-lg group-focus-within:text-indigo-500 transition"></i>
                                    <input type="text" name="name" value="{{ $profile->name }}" class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm font-medium text-slate-700 placeholder:text-slate-300">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase">Headline / Jabatan</label>
                                <div class="relative group">
                                    <i class="ph ph-briefcase absolute left-3 top-3 text-slate-400 text-lg group-focus-within:text-indigo-500 transition"></i>
                                    <input type="text" name="headline" value="{{ $profile->headline }}" class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm font-medium text-slate-700 placeholder:text-slate-300">
                                </div>
                            </div>
                        </div>

                        <!-- Baris 2: Deskripsi -->
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase">Tentang Saya</label>
                            <div class="relative group">
                                <i class="ph ph-text-align-left absolute left-3 top-3 text-slate-400 text-lg group-focus-within:text-indigo-500 transition"></i>
                                <textarea name="about_text" rows="4" class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm text-slate-600 resize-none placeholder:text-slate-300">{{ $profile->about_text }}</textarea>
                            </div>
                            <p class="text-[10px] text-slate-400 text-right">*Akan muncul di halaman depan bagian 'Hero'</p>
                        </div>

                        <!-- Baris 3: Kontak (Background Abu) -->
                        <div class="p-6 bg-slate-50 rounded-xl border border-slate-100 space-y-5">
                            <div class="flex items-center gap-2 mb-2 border-b border-slate-200 pb-2">
                                <i class="ph-fill ph-address-book text-indigo-400"></i>
                                <span class="text-xs font-bold text-slate-500 uppercase">Kontak & Sosial Media</span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <input type="email" name="email" value="{{ $profile->email }}" placeholder="Email Address" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition">
                                </div>
                                <div>
                                    <input type="text" name="cv_link" value="{{ $profile->cv_link }}" placeholder="Link CV (Google Drive)" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition">
                                </div>
                                <div>
                                    <input type="text" name="github_link" value="{{ $profile->github_link }}" placeholder="GitHub URL" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition">
                                </div>
                                <div>
                                    <input type="text" name="linkedin_link" value="{{ $profile->linkedin_link }}" placeholder="LinkedIn URL" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition">
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button type="submit" class="bg-slate-900 text-white text-sm font-bold px-6 py-3 rounded-xl hover:bg-indigo-600 transition shadow-lg hover:shadow-indigo-500/30 flex items-center gap-2">
                                <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- KOLOM KANAN: Foto Profil (Lebih Ringkas) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sticky top-6 text-center">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-6">Foto Profil</h3>
                    
                    <!-- Preview Foto -->
                    <div class="relative w-40 h-40 mx-auto mb-6 group">
                        <!-- Efek Glow -->
                        <div class="absolute inset-0 bg-indigo-400 rounded-full blur-xl opacity-20 group-hover:opacity-30 transition duration-500"></div>
                        
                        @if($profile->avatar)
                            <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="relative w-full h-full object-cover rounded-full border-[5px] border-white shadow-xl group-hover:scale-105 transition duration-300">
                        @else
                            <div class="relative w-full h-full bg-indigo-50 rounded-full flex items-center justify-center text-indigo-300 border-[5px] border-white shadow-xl">
                                <i class="ph-fill ph-user text-6xl"></i>
                            </div>
                        @endif
                        
                        <!-- Icon Kamera Pojok -->
                        <div class="absolute bottom-2 right-2 bg-white text-indigo-600 p-2 rounded-full shadow-md border border-slate-100">
                            <i class="ph-bold ph-camera"></i>
                        </div>
                    </div>

                    <!-- Form Upload Foto (Terpisah agar rapi) -->
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $profile->name }}">
                        
                        <div class="space-y-3">
                            <label class="block w-full cursor-pointer group">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" name="avatar" class="block w-full text-xs text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-xs file:font-bold
                                    file:bg-indigo-50 file:text-indigo-600
                                    group-hover:file:bg-indigo-100
                                    transition
                                "/>
                            </label>
                            <button type="submit" class="w-full py-2.5 bg-white border border-slate-200 text-slate-600 text-xs font-bold rounded-lg hover:border-indigo-500 hover:text-indigo-600 transition">
                                Upload Foto Baru
                            </button>
                        </div>
                    </form>

                    <p class="text-[10px] text-slate-400 mt-4 leading-relaxed">
                        Disarankan rasio 1:1 (Persegi).<br>Format JPG/PNG maks 2MB.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection