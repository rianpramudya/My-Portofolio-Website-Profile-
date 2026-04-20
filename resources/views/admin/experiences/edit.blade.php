@extends('layouts.admin')

@section('header', 'Edit Pengalaman')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 shadow-sm p-6 mb-10">
    <form action="{{ route('admin.experiences.update', $experience->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tipe</label>
                <select name="type" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="work" {{ trim($experience->type) == 'work' ? 'selected' : '' }}>Pekerjaan (Work)</option>
                    <option value="education" {{ trim($experience->type) == 'education' ? 'selected' : '' }}>Pendidikan (Education)</option>
                    <option value="organization" {{ trim($experience->type) == 'organization' ? 'selected' : '' }}>Organisasi (Organization)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode</label>
                <input type="text" name="period" value="{{ old('period', $experience->period) }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Posisi / Gelar</label>
            <input type="text" name="role" value="{{ old('role', $experience->role) }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Instansi / Perusahaan</label>
            <input type="text" name="company" value="{{ old('company', $experience->company) }}" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi (Website)</label>
            <textarea name="description" rows="4" class="w-full rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" required>{{ old('description', $experience->description) }}</textarea>
        </div>

        <div class="space-y-3 p-5 bg-slate-50 border border-slate-200 rounded-xl">
            <div>
                <label class="text-xs font-bold text-slate-700 uppercase flex items-center gap-2">
                    <i class="ph-bold ph-file-text text-indigo-500"></i> Informasi CV (Berupa Poin)
                </label>
                <p class="text-[10px] text-slate-500 mt-1">Poin-poin ini khusus untuk tampilan di PDF CV.</p>
            </div>

            <div id="cv-points-container" class="space-y-3">
                @php
                    $cvPoints = old('cv_descriptions', $experience->cv_descriptions ?? []);
                    // Jika data string (karena belum tercast), decode dulu
                    if(is_string($cvPoints)) $cvPoints = json_decode($cvPoints, true) ?? [];
                @endphp

                @foreach($cvPoints as $point)
                <div class="cv-point-row flex items-start gap-2">
                    <div class="pt-2 text-slate-400"><i class="ph-bold ph-list-dashes"></i></div>
                    <input type="text" name="cv_descriptions[]" value="{{ $point }}" class="flex-1 px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm transition" placeholder="Contoh: Mengelola tampilan digital himpunan...">
                    <button type="button" class="btn-remove-point p-2 text-slate-400 hover:text-red-500 rounded-lg transition">
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
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg">
                Update Data
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('cv-points-container');
        const btnAdd = document.getElementById('btn-add-point');

        // Fungsi untuk membuat baris baru dari nol (Tanpa Clone)
        function createNewRow(value = '') {
            const row = document.createElement('div');
            row.className = 'cv-point-row flex items-start gap-2';
            row.innerHTML = `
                <div class="pt-2 text-slate-400"><i class="ph-bold ph-list-dashes"></i></div>
                <input type="text" name="cv_descriptions[]" value="${value}" class="flex-1 px-3 py-2 bg-white border border-slate-300 rounded-lg text-sm transition" placeholder="Contoh: Mengelola tampilan digital himpunan...">
                <button type="button" class="btn-remove-point p-2 text-slate-400 hover:text-red-500 rounded-lg transition">
                    <i class="ph-bold ph-trash"></i>
                </button>
            `;
            return row;
        }

        function updateRemoveButtons() {
            const rows = container.querySelectorAll('.cv-point-row');
            rows.forEach((row) => {
                const btn = row.querySelector('.btn-remove-point');
                // Sembunyikan tombol hapus jika hanya ada 1 baris
                if (rows.length === 1) {
                    btn.style.visibility = 'hidden';
                } else {
                    btn.style.visibility = 'visible';
                }
            });
        }

        // Jalankan saat pertama kali muat
        updateRemoveButtons();

        btnAdd.addEventListener('click', function() {
            const newRow = createNewRow();
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