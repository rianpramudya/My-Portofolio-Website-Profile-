@extends('layouts.admin')

@section('header', 'Edit Pengalaman')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-6">
    <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label>
                <select name="type" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="work" {{ $experience->type == 'work' ? 'selected' : '' }}>Pekerjaan (Work)</option>
                    <option value="education" {{ $experience->type == 'education' ? 'selected' : '' }}>Pendidikan (Education)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode</label>
                <input type="text" name="period" value="{{ $experience->period }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Posisi / Gelar</label>
            <input type="text" name="role" value="{{ $experience->role }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Instansi / Perusahaan</label>
            <input type="text" name="company" value="{{ $experience->company }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required>{{ $experience->description }}</textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.experiences.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition">Update Data</button>
        </div>
    </form>
</div>
@endsection