@extends('layouts.admin')

@section('header', 'Kelola Projects')

@section('content')
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="font-bold text-slate-800">Daftar Proyek</h3>
        <a href="{{ route('admin.projects.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition flex items-center gap-2">
            <i class="ph-bold ph-plus"></i> Tambah Baru
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-3">Thumbnail</th>
                    <th class="px-6 py-3">Judul Proyek</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($projects as $project)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-3 w-24">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                        @else
                            <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400 border border-slate-200"><i class="ph-fill ph-image"></i></div>
                        @endif
                    </td>
                    <td class="px-6 py-3 font-medium text-slate-800">{{ $project->title }}</td>
                    <td class="px-6 py-3"><span class="px-2 py-1 bg-indigo-50 text-indigo-600 rounded text-xs font-bold">{{ $project->category }}</span></td>
                    <td class="px-6 py-3 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="p-2 bg-amber-50 text-amber-600 rounded hover:bg-amber-100 transition"><i class="ph-bold ph-pencil-simple"></i></a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded hover:bg-red-100 transition"><i class="ph-bold ph-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada data proyek.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection