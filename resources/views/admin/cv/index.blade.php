@extends('layouts.admin')

@section('header', 'CV Generator')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8 text-center">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Pilih Format CV</h2>
        <p class="text-slate-500 mb-8">Pilih gaya CV yang ingin Anda generate berdasarkan data profil Anda.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Opsi ATS Friendly -->
            <form action="{{ route('admin.cv.generate') }}" method="POST" target="_blank" class="group relative block">
                @csrf
                <input type="hidden" name="type" value="ats">
                <button type="submit" class="w-full text-left h-full">
                    <div class="border-2 border-slate-200 rounded-2xl p-6 hover:border-indigo-500 hover:ring-4 hover:ring-indigo-50 transition h-full flex flex-col items-center text-center group-hover:-translate-y-1">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-3xl text-slate-600 mb-4 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition">
                            <i class="ph-fill ph-file-text"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">ATS Friendly</h3>
                        <p class="text-sm text-slate-500 mb-4">Format bersih, minimalis, dan mudah dibaca oleh mesin ATS. Cocok untuk melamar ke perusahaan korporat.</p>
                        <span class="px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg group-hover:bg-indigo-600 transition">Generate ATS</span>
                    </div>
                </button>
            </form>

            <!-- Opsi Creative -->
            <form action="{{ route('admin.cv.generate') }}" method="POST" target="_blank" class="group relative block">
                @csrf
                <input type="hidden" name="type" value="creative">
                <button type="submit" class="w-full text-left h-full">
                    <div class="border-2 border-slate-200 rounded-2xl p-6 hover:border-fuchsia-500 hover:ring-4 hover:ring-fuchsia-50 transition h-full flex flex-col items-center text-center group-hover:-translate-y-1">
                        <div class="w-16 h-16 bg-fuchsia-50 rounded-full flex items-center justify-center text-3xl text-fuchsia-600 mb-4">
                            <i class="ph-fill ph-paint-brush-broad"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Creative Design</h3>
                        <p class="text-sm text-slate-500 mb-4">Tampilan visual menarik dengan warna dan layout modern. Cocok untuk industri kreatif atau startup.</p>
                        <span class="px-4 py-2 bg-white border border-slate-300 text-slate-700 text-sm font-bold rounded-lg group-hover:bg-fuchsia-600 group-hover:text-white group-hover:border-fuchsia-600 transition">Generate Creative</span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection