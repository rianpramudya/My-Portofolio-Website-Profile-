@extends('layouts.admin')

@section('header', 'Tambah Project Baru')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-10">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
        <h3 class="font-bold text-slate-800">Form Tambah Data</h3>
        <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-500 hover:text-indigo-600 flex items-center gap-1">
            <i class="ph-bold ph-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="p-6">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase">Judul Proyek <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm" required placeholder="Contoh: E-Commerce App">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase">Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="category" value="{{ old('category') }}" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm" required placeholder="Contoh: Web Development">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-500 uppercase">Link Project (URL)</label>
                    <div class="relative">
                        <i class="ph ph-link absolute left-3 top-3 text-slate-400"></i>
                        <input type="url" name="link_url" value="{{ old('link_url') }}" class="w-full pl-9 pr-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm" placeholder="https://github.com/...">
                    </div>
                </div>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-bold text-slate-500 uppercase">Deskripsi (Untuk Website) <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm resize-none" required placeholder="Jelaskan detail proyek untuk pengunjung website...">{{ old('description') }}</textarea>
            </div>

            <div class="space-y-3 p-5 bg-slate-50 border border-slate-200 rounded-xl">
                <div>
                    <label class="text-xs font-bold text-slate-700 uppercase flex items-center gap-2">
                        <i class="ph-bold ph-file-text text-indigo-500"></i> Informasi CV (Opsional - Berupa Poin)
                    </label>
                    <p class="text-[10px] text-slate-500 mt-1">Gunakan kata kerja aktif. Poin-poin ini hanya akan muncul saat men-generate CV PDF.</p>
                </div>

                <div id="cv-points-container" class="space-y-3">
                    @php
                        // Ambil old input jika ada error validasi, jika tidak beri 1 array kosong
                        $cvPoints = old('cv_descriptions', ['']);
                    @endphp

                    @foreach($cvPoints as $index => $point)
                    <div class="cv-point-row flex items-start gap-2">
                        <div class="pt-2 text-slate-400"><i class="ph-bold ph-list-dashes"></i></div>
                        <input type="text" name="cv_descriptions[]" value="{{ $point }}" class="flex-1 px-3 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm placeholder:text-slate-300" placeholder="Contoh: Mengembangkan fitur autentikasi menggunakan Laravel...">
                        
                        <button type="button" class="btn-remove-point p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition {{ count($cvPoints) == 1 ? 'hidden' : '' }}" title="Hapus poin">
                            <i class="ph-bold ph-trash"></i>
                        </button>
                    </div>
                    @endforeach
                </div>

                <button type="button" id="btn-add-point" class="mt-2 w-full py-2 border-2 border-dashed border-indigo-200 text-indigo-600 bg-indigo-50/50 hover:bg-indigo-50 rounded-lg font-bold text-xs transition flex items-center justify-center gap-1">
                    <i class="ph-bold ph-plus"></i> Tambah Poin CV
                </button>
            </div>

            <div class="p-4 border border-slate-200 rounded-xl space-y-4">
                <label class="text-xs font-bold text-slate-500 uppercase">Gambar Cover</label>
                <div class="flex-1">
                    <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 cursor-pointer"/>
                    <p class="text-[10px] text-slate-400 mt-2">Format JPG, PNG. Maks 2MB.</p>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 bg-white text-slate-600 border border-slate-200 rounded-lg font-bold hover:bg-slate-50 transition text-sm">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 text-sm flex items-center gap-2">
                    <i class="ph-bold ph-plus"></i> Simpan Project
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('cv-points-container');
        const btnAdd = document.getElementById('btn-add-point');

        // Fungsi untuk mengupdate visibilitas tombol hapus
        function updateRemoveButtons() {
            const rows = container.querySelectorAll('.cv-point-row');
            rows.forEach((row, index) => {
                const btnRemove = row.querySelector('.btn-remove-point');
                if (rows.length === 1) {
                    btnRemove.classList.add('hidden');
                } else {
                    btnRemove.classList.remove('hidden');
                }
            });
        }

        // Event listener untuk tombol tambah
        btnAdd.addEventListener('click', function() {
            // Clone baris pertama
            const firstRow = container.querySelector('.cv-point-row');
            const newRow = firstRow.cloneNode(true);
            
            // Kosongkan value input
            newRow.querySelector('input').value = '';
            
            // Tambahkan ke container
            container.appendChild(newRow);
            
            // Fokus ke input baru
            newRow.querySelector('input').focus();
            
            updateRemoveButtons();
        });

        // Event listener untuk tombol hapus (menggunakan event delegation)
        container.addEventListener('click', function(e) {
            // Cari tombol hapus yang diklik
            const btnRemove = e.target.closest('.btn-remove-point');
            
            if (btnRemove) {
                const row = btnRemove.closest('.cv-point-row');
                const rows = container.querySelectorAll('.cv-point-row');
                
                // Jangan hapus jika sisa 1 baris
                if (rows.length > 1) {
                    row.remove();
                    updateRemoveButtons();
                }
            }
        });
    });
</script>
@endsection