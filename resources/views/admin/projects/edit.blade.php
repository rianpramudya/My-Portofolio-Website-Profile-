@extends('layouts.admin')

@section('header', 'Edit Project')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
        <h3 class="font-bold text-slate-800">Form Edit Data</h3>
        <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-500 hover:text-indigo-600 flex items-center gap-1">
            <i class="ph-bold ph-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Judul -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase">Judul Proyek <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm" required placeholder="Contoh: E-Commerce App">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase">Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="category" value="{{ old('category', $project->category) }}" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm" required placeholder="Contoh: Web Development">
                </div>

                <!-- Link -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase">Link Project (URL)</label>
                    <div class="relative">
                        <i class="ph ph-link absolute left-3 top-3 text-slate-400"></i>
                        <input type="url" name="link_url" value="{{ old('link_url', $project->link_url) }}" class="w-full pl-9 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm" placeholder="https://github.com/...">
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase">Deskripsi <span class="text-red-500">*</span></label>
                <textarea name="description" rows="5" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm resize-none" required placeholder="Jelaskan detail proyek...">{{ old('description', $project->description) }}</textarea>
            </div>

            <!-- Gambar -->
            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl space-y-4">
                <label class="text-xs font-bold text-slate-500 uppercase">Gambar Cover</label>
                
                <div class="flex items-start gap-6">
                    <!-- Preview Gambar Lama -->
                    <div class="flex-shrink-0">
                        <p class="text-[10px] text-slate-400 mb-2">Gambar Saat Ini:</p>
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" class="w-32 h-24 object-cover rounded-lg border border-slate-300 shadow-sm">
                        @else
                            <div class="w-32 h-24 bg-slate-200 rounded-lg flex items-center justify-center text-slate-400 border border-slate-300 text-xs">
                                No Image
                            </div>
                        @endif
                    </div>

                    <!-- Input Gambar Baru -->
                    <div class="flex-1">
                        <p class="text-[10px] text-slate-400 mb-2">Ganti Gambar (Opsional):</p>
                        <label class="block w-full cursor-pointer group">
                            <span class="sr-only">Choose file</span>
                            <input type="file" name="image" class="block w-full text-sm text-slate-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-xs file:font-bold
                                file:bg-white file:text-indigo-600
                                file:border file:border-indigo-100
                                hover:file:bg-indigo-50
                                cursor-pointer transition
                            "/>
                        </label>
                        <p class="text-[10px] text-slate-400 mt-2">Format JPG, PNG. Maks 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-lg font-bold hover:bg-slate-50 transition text-sm">
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