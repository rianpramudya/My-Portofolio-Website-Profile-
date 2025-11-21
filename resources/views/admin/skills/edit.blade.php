@extends('layouts.admin')

@section('header', 'Edit Skill')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
    <div class="mb-6 flex items-center justify-between">
        <h3 class="font-bold text-slate-800">Edit Data Skill</h3>
        <a href="{{ route('admin.skills.index') }}" class="text-sm text-slate-500 hover:text-indigo-600">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="text-xs font-bold text-slate-500 uppercase">Nama Skill</label>
            <input type="text" name="name" value="{{ $skill->name }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 text-sm" required>
        </div>
        
        <div>
            <label class="text-xs font-bold text-slate-500 uppercase">Kategori</label>
            <select name="category" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 text-sm">
                <option value="Backend" {{ $skill->category == 'Backend' ? 'selected' : '' }}>Backend</option>
                <option value="Frontend" {{ $skill->category == 'Frontend' ? 'selected' : '' }}>Frontend</option>
                <option value="Tools" {{ $skill->category == 'Tools' ? 'selected' : '' }}>Tools</option>
                <option value="Design" {{ $skill->category == 'Design' ? 'selected' : '' }}>Design</option>
            </select>
        </div>
        
        <div>
            <label class="text-xs font-bold text-slate-500 uppercase">Persentase (%)</label>
            <input type="number" name="proficiency" value="{{ $skill->proficiency }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 text-sm" min="0" max="100" required>
        </div>
        
        <div>
            <label class="text-xs font-bold text-slate-500 uppercase">Icon Class (Phosphor)</label>
            <div class="flex gap-2">
                <div class="w-10 h-10 flex-shrink-0 bg-slate-100 rounded flex items-center justify-center text-xl text-slate-600">
                    <i class="ph {{ $skill->icon }}"></i>
                </div>
                <input type="text" name="icon" value="{{ $skill->icon }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 text-sm" required>
            </div>
        </div>
        
        <div class="pt-2">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg font-bold hover:bg-indigo-700 transition">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection