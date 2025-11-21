@extends('layouts.admin')

@section('header', 'Tambah Pengalaman Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-6">
    <form action="{{ route('admin.experiences.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label>
                <select name="type" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="work">Pekerjaan (Work)</option>
                    <option value="education">Pendidikan (Education)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode</label>
                <input type="text" name="period" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: 2020 - 2024" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Posisi / Gelar</label>
            <input type="text" name="role" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Contoh: Senior Backend Dev / S1 Teknik Informatika">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Instansi / Perusahaan</label>
            <input type="text" name="company" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Contoh: Google Indonesia">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Jelaskan tanggung jawab atau pencapaian Anda..."></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.experiences.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection