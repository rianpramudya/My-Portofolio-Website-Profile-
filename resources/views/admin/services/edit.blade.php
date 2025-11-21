@extends('layouts.admin')

@section('header', 'Edit Layanan')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
        <h3 class="font-bold text-slate-800">Form Edit Layanan</h3>
        <a href="{{ route('admin.services.index') }}" class="text-sm text-slate-500 hover:text-indigo-600 flex items-center gap-1">
            <i class="ph-bold ph-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            
            <!-- Judul -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase">Judul Layanan <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $service->title) }}" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm" required placeholder="Contoh: Web Development">
            </div>

            <!-- Ikon -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase">Ikon (Phosphor Icon Class) <span class="text-red-500">*</span></label>
                <div class="flex gap-3">
                    <!-- Preview Icon -->
                    <div class="w-10 h-10 flex-shrink-0 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-xl border border-indigo-100">
                        <i class="ph {{ $service->icon }}"></i>
                    </div>
                    <div class="flex-1">
                        <input type="text" name="icon" value="{{ old('icon', $service->icon) }}" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm" required placeholder="Contoh: ph-desktop">
                        <p class="text-[10px] text-slate-400 mt-1.5">
                            Gunakan class dari <a href="https://phosphoricons.com" target="_blank" class="text-indigo-500 hover:underline">Phosphor Icons</a>. Contoh: <code>ph-code</code>, <code>ph-paint-brush</code>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase">Deskripsi Singkat <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm resize-none" required placeholder="Jelaskan layanan ini...">{{ old('description', $service->description) }}</textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-lg font-bold hover:bg-slate-50 transition text-sm">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 text-sm flex items-center gap-2">
                    <i class="ph-bold ph-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection