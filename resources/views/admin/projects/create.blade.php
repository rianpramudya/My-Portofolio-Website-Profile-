@extends('layouts.admin')

@section('header', 'Tambah Project Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-6">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Proyek</label>
            <input type="text" name="title" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Contoh: E-Commerce App">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                <input type="text" name="category" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Contoh: Web Development">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Link Project (URL)</label>
                <input type="url" name="link_url" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="https://github.com/...">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Gambar Cover</label>
            <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition">Simpan Project</button>
        </div>
    </form>
</div>
@endsection