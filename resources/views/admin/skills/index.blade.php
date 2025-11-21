@extends('layouts.admin')

@section('header', 'Kelola Keahlian (Skills)')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    
    <!-- Form Tambah Skill (Kiri - Sticky) -->
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm h-fit sticky top-6">
        <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
            <i class="ph-bold ph-plus-circle text-indigo-600"></i> Tambah Skill Baru
        </h3>
        <form action="{{ route('admin.skills.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Nama Skill</label>
                <input type="text" name="name" placeholder="Contoh: Laravel" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 text-sm" required>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Kategori</label>
                <select name="category" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 text-sm">
                    <option value="Backend">Backend</option>
                    <option value="Frontend">Frontend</option>
                    <option value="Tools">Tools</option>
                    <option value="Design">Design</option>
                </select>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Persentase (%)</label>
                <input type="number" name="proficiency" placeholder="0 - 100" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 text-sm" min="0" max="100" required>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Icon Class (Phosphor)</label>
                <input type="text" name="icon" placeholder="ph-code" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 text-sm" required>
                <a href="https://phosphoricons.com/" target="_blank" class="text-[10px] text-indigo-500 hover:underline mt-1 block">Cari referensi ikon disini &rarr;</a>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Simpan</button>
        </form>
    </div>

    <!-- List Skills (Kanan - Grid Card) -->
    <div class="md:col-span-2">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($skills as $skill)
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between group hover:border-indigo-300 transition">
                <div class="flex items-center gap-4">
                    <!-- Icon Preview -->
                    <div class="w-12 h-12 bg-slate-50 rounded-lg flex items-center justify-center text-indigo-600 text-2xl border border-slate-100">
                        <i class="ph {{ $skill->icon }}"></i>
                    </div>
                    <!-- Info Skill -->
                    <div>
                        <h4 class="font-bold text-slate-800">{{ $skill->name }}</h4>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">{{ $skill->category }} • <span class="text-indigo-600">{{ $skill->proficiency }}%</span></p>
                    </div>
                </div>
                
                <!-- Tombol Aksi (Edit & Hapus) -->
                <div class="flex items-center gap-2 opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity">
                    <!-- Tombol Edit (Mengarah ke Halaman Edit yang baru dibuat) -->
                    <a href="{{ route('admin.skills.edit', $skill->id) }}" class="p-2 text-amber-500 hover:bg-amber-50 rounded-lg transition" title="Edit">
                        <i class="ph-bold ph-pencil-simple text-lg"></i>
                    </a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Hapus skill ini?')">
                        @csrf @method('DELETE')
                        <button class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                            <i class="ph-bold ph-trash text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pesan Kosong -->
        @if($skills->isEmpty())
            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-slate-300">
                <i class="ph-duotone ph-files text-4xl text-slate-300 mb-2"></i>
                <p class="text-slate-400">Belum ada skill yang ditambahkan.</p>
            </div>
        @endif
    </div>
</div>
@endsection