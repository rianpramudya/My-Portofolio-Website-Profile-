@extends('layouts.admin')

@section('header', 'Kelola Pengalaman')

@section('content')
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="font-bold text-slate-800">Riwayat Pengalaman & Pendidikan</h3>
        <a href="{{ route('admin.experiences.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition flex items-center gap-2">
            <i class="ph-bold ph-plus"></i> Tambah Baru
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-3">Posisi / Gelar</th>
                    <th class="px-6 py-3">Instansi</th>
                    <th class="px-6 py-3">Periode</th>
                    <th class="px-6 py-3">Tipe</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($experiences as $item)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-3 font-medium text-slate-800">{{ $item->role }}</td>
                    <td class="px-6 py-3">{{ $item->company }}</td>
                    <td class="px-6 py-3">{{ $item->period }}</td>
                    <td class="px-6 py-3">
                        @if($item->type == 'work')
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-xs font-bold">Pekerjaan</span>
                        @else
                            <span class="px-2 py-1 bg-emerald-50 text-emerald-600 rounded text-xs font-bold">Pendidikan</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.experiences.edit', $item->id) }}" class="p-2 bg-amber-50 text-amber-600 rounded hover:bg-amber-100 transition"><i class="ph-bold ph-pencil-simple"></i></a>
                            <form action="{{ route('admin.experiences.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-red-50 text-red-600 rounded hover:bg-red-100 transition"><i class="ph-bold ph-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data pengalaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection