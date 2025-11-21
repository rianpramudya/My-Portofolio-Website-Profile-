@extends('layouts.admin')

@section('header', 'Tambah Layanan Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-6">
    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Layanan</label>
            <input type="text" name="title" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Contoh: Web Development">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Ikon (Phosphor Icon Class)</label>
            <div class="flex gap-3">
                <div class="w-10 h-10 flex-shrink-0 bg-slate-100 rounded flex items-center justify-center text-xl text-slate-600">
                    <i class="ph-fill ph-cube"></i>
                </div>
                <input type="text" name="icon" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Contoh: ph-desktop">
            </div>
            <p class="text-xs text-slate-400 mt-1">Gunakan class icon dari <a href="https://phosphoricons.com" target="_blank" class="text-indigo-500 underline">Phosphor Icons</a>. Contoh: <code>ph-desktop</code>, <code>ph-code</code>, <code>ph-database</code>.</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Singkat</label>
            <textarea name="description" rows="3" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Jelaskan apa yang Anda tawarkan..."></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection