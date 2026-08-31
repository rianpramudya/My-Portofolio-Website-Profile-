@extends('layouts.admin')

@section('title', 'Tambah Sertifikasi')
@section('header', 'Tambah Sertifikasi')

@section('content')
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
        <form action="{{ route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Judul Sertifikasi</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-input" placeholder="Contoh: AWS Cloud Practitioner" required>
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Penerbit</label>
                    <input type="text" name="issuer" value="{{ old('issuer') }}" class="form-input" placeholder="Contoh: Amazon Web Services" required>
                    @error('issuer')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Terbit</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="form-input" required>
                    @error('date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Credential ID</label>
                    <input type="text" name="credential" value="{{ old('credential') }}" class="form-input" placeholder="Contoh: ABC123XYZ">
                    @error('credential')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">URL Verifikasi</label>
                <input type="url" name="url" value="{{ old('url') }}" class="form-input" placeholder="https://...">
                @error('url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- FILE SERTIFIKAT --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">File Sertifikat</label>
                <input type="file" name="image" accept=".pdf,.jpg,.jpeg,.png,.webp"
                       class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                <p class="text-xs text-slate-400 mt-1">Format: PDF, JPG, PNG, WEBP. Maksimal 5MB.</p>
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3" class="form-input" placeholder="Deskripsi singkat...">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.certifications.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
@endsection