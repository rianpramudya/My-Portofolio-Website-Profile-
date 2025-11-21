@extends('layouts.admin')

@section('header', 'Kelola Layanan (Services)')

@section('content')
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h3 class="font-bold text-slate-800">Daftar Layanan</h3>
        <a href="{{ route('admin.services.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-indigo-700 transition flex items-center gap-2">
            <i class="ph-bold ph-plus"></i> Tambah Baru
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        @forelse($services as $service)
        <!-- CARD CONTAINER: Flex Col & H-Full agar tinggi seragam -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 hover:border-indigo-300 transition group flex flex-col h-full shadow-sm hover:shadow-md">
            
            <!-- BAGIAN ATAS (Icon & Teks) -->
            <div class="flex-1">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-2xl mb-4">
                    <i class="ph {{ $service->icon }}"></i>
                </div>
                
                <!-- Judul -->
                <h4 class="text-lg font-bold text-slate-800 mb-2 line-clamp-1" title="{{ $service->title }}">
                    {{ $service->title }}
                </h4>
                
                <!-- Deskripsi -->
                <p class="text-sm text-slate-500 leading-relaxed mb-6 line-clamp-3" title="{{ $service->description }}">
                    {{ $service->description }}
                </p>
            </div>
            
            <!-- BAGIAN BAWAH (Tombol) - ID Dihapus, Justify End -->
            <div class="flex justify-end items-center border-t border-slate-100 pt-4 mt-auto">
                <div class="flex items-center gap-3">
                    <!-- Tombol Edit -->
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="text-sm font-bold text-slate-500 hover:text-indigo-600 flex items-center gap-1 transition">
                        <i class="ph-bold ph-pencil-simple"></i> Edit
                    </a>
                    
                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm font-bold text-slate-500 hover:text-red-500 flex items-center gap-1 transition">
                            <i class="ph-bold ph-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>

        </div>
        @empty
        <div class="col-span-3 text-center py-12 border-2 border-dashed border-slate-100 rounded-xl">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                <i class="ph-duotone ph-squares-four text-3xl"></i>
            </div>
            <p class="text-slate-400">Belum ada layanan yang ditambahkan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection