@extends('layouts.admin')

@section('header', 'Dashboard & Profil')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Stats Cards -->
        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <div class="text-slate-500 text-sm mb-1">Total Proyek</div>
                <div class="text-3xl font-bold text-indigo-600">{{ $projectCount }}</div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <div class="text-slate-500 text-sm mb-1">Pengalaman</div>
                <div class="text-3xl font-bold text-indigo-600">{{ $experienceCount }}</div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-sm mb-1">Status Website</div>
                    <div class="text-green-600 font-bold flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Online
                    </div>
                </div>
                <a href="{{ route('home') }}" target="_blank" class="text-indigo-600 hover:underline text-sm">Lihat Web &rarr;</a>
            </div>
        </div>

        <!-- Form Edit Profil -->
        <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold mb-6 pb-4 border-b border-slate-100">Edit Informasi Profil</h3>
            
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $profile->name }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Headline / Jabatan</label>
                        <input type="text" name="headline" value="{{ $profile->headline }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tentang Saya (Deskripsi)</label>
                    <textarea name="about_text" rows="4" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">{{ $profile->about_text }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email Publik</label>
                        <input type="email" name="email" value="{{ $profile->email }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Link CV (Google Drive/PDF)</label>
                        <input type="text" name="cv_link" value="{{ $profile->cv_link }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-4 mt-4">
                    <h4 class="text-sm font-bold text-slate-900 mb-4">Social Links</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">GitHub URL</label>
                            <input type="text" name="github_link" value="{{ $profile->github_link }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">LinkedIn URL</label>
                            <input type="text" name="linkedin_link" value="{{ $profile->linkedin_link }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/30">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar Kanan (Foto Profil) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 text-center">
                <h3 class="text-sm font-bold text-slate-900 mb-4">Foto Profil</h3>
                
                <div class="relative w-40 h-40 mx-auto mb-4">
                    @if($profile->avatar)
                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="w-full h-full object-cover rounded-full border-4 border-slate-50 shadow-md">
                    @else
                        <div class="w-full h-full bg-slate-100 rounded-full flex items-center justify-center text-slate-400 border-4 border-slate-50">
                            <i class="ph ph-user text-4xl"></i>
                        </div>
                    @endif
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="name" value="{{ $profile->name }}">
                    
                    <label class="block">
                        <span class="sr-only">Choose profile photo</span>
                        <input type="file" name="avatar" class="block w-full text-sm text-slate-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-700
                          hover:file:bg-indigo-100
                        "/>
                    </label>
                    <button type="submit" class="mt-4 w-full py-2 text-sm text-indigo-600 font-medium hover:bg-indigo-50 rounded-lg transition">
                        Upload Foto Baru
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection