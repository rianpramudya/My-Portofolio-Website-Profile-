@extends('layouts.admin')

@section('header', 'Buat Surat Lamaran')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-8">
    <div class="text-center mb-8">
        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-2xl mx-auto mb-3">
            <i class="ph-fill ph-envelope-open"></i>
        </div>
        <h2 class="text-xl font-bold text-slate-800">Generator Surat Lamaran</h2>
        <p class="text-slate-500 text-sm">Isi detail tujuan, sistem akan membuatkan surat otomatis untuk Anda.</p>
    </div>

    <form action="{{ route('admin.letter.generate') }}" method="POST" target="_blank" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Penerima / HRD</label>
            <input type="text" name="recipient_name" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: Bapak Budi / HR Manager" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Perusahaan</label>
                <input type="text" name="company_name" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: PT. Teknologi Maju" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Alamat Perusahaan</label>
                <input type="text" name="company_address" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: Jl. Sudirman No. 1, Jakarta" required>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Posisi yang Dilamar</label>
            <input type="text" name="position" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: Senior Backend Developer" required>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 flex items-center justify-center gap-2">
            <i class="ph-bold ph-printer"></i> Generate & Print Surat
        </button>
    </form>
</div>
@endsection