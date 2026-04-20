@extends('layouts.admin')

@section('header', 'Tambah Pengalaman Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-6 mb-10">
    <form action="{{ route('admin.experiences.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label>
                <select name="type" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="work" {{ old('type') == 'work' ? 'selected' : '' }}>Pekerjaan (Work)</option>
                    <option value="education" {{ old('type') == 'education' ? 'selected' : '' }}>Pendidikan (Education)</option>
                    <option value="organization" {{ old('type') == 'organization' ? 'selected' : '' }}>Organisasi (Organization)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode</label>
                <input type="text" name="period" value="{{ old('period') }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Contoh: 2020 - 2024" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Posisi / Gelar</label>
            <input type="text" name="role" value="{{ old('role') }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Contoh: Senior Backend Dev / S1 Teknik Informatika">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Instansi / Perusahaan</label>
            <input type="text" name="company" value="{{ old('company') }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Contoh: Google Indonesia">
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi (Website)</label>
            <textarea name="description" rows="4" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required placeholder="Jelaskan tanggung jawab atau pencapaian Anda untuk tampilan web portofolio...">{{ old('description') }}</textarea>
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

                @foreach($cvPoints as $point)
                <div class="cv-point-row flex items-start gap-2">
                    <div class="pt-2 text-slate-400"><i class="ph-bold ph-list-dashes"></i></div>
                    <input type="text" name="cv_descriptions[]" value="{{ $point }}" class="flex-1 px-3 py-2 bg-white border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 transition text-sm placeholder:text-slate-300" placeholder="Contoh: Mengelola tampilan digital himpunan menggunakan Figma...">
                    
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

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.experiences.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg font-medium hover:bg-slate-200 transition">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                Simpan Pengalaman
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('cv-points-container');
        const btnAdd = document.getElementById('btn-add-point');

        function updateRemoveButtons() {
            const rows = container.querySelectorAll('.cv-point-row');
            rows.forEach((row) => {
                const btnRemove = row.querySelector('.btn-remove-point');
                if (rows.length === 1) {
                    btnRemove.classList.add('hidden');
                } else {
                    btnRemove.classList.remove('hidden');
                }
            });
        }

        btnAdd.addEventListener('click', function() {
            const firstRow = container.querySelector('.cv-point-row');
            const newRow = firstRow.cloneNode(true);
            
            newRow.querySelector('input').value = '';
            container.appendChild(newRow);
            newRow.querySelector('input').focus();
            
            updateRemoveButtons();
        });

        container.addEventListener('click', function(e) {
            const btnRemove = e.target.closest('.btn-remove-point');
            if (btnRemove) {
                const rows = container.querySelectorAll('.cv-point-row');
                if (rows.length > 1) {
                    btnRemove.closest('.cv-point-row').remove();
                    updateRemoveButtons();
                }
            }
        });
    });
</script>
@endsection