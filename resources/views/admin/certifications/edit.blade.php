@extends('layouts.admin')

@section('title', 'Edit Sertifikasi')
@section('header', 'Edit Sertifikasi')

@section('content')
    @php
        $ext = $certification->image ? Str::lower(pathinfo($certification->image, PATHINFO_EXTENSION)) : null;
        $isPdf = $ext === 'pdf';
    @endphp

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
        <form action="{{ route('admin.certifications.update', $certification) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Judul Sertifikasi</label>
                    <input type="text" name="title" value="{{ old('title', $certification->title) }}" class="form-input" required>
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Penerbit</label>
                    <input type="text" name="issuer" value="{{ old('issuer', $certification->issuer) }}" class="form-input" required>
                    @error('issuer')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Tanggal Terbit</label>
                    <input type="date" name="date" value="{{ old('date', $certification->date->format('Y-m-d')) }}" class="form-input" required>
                    @error('date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Credential ID</label>
                    <input type="text" name="credential" value="{{ old('credential', $certification->credential) }}" class="form-input">
                    @error('credential')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">URL Verifikasi</label>
                <input type="url" name="url" value="{{ old('url', $certification->url) }}" class="form-input" placeholder="https://...">
                @error('url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- FILE SERTIFIKAT --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">File Sertifikat</label>

                {{-- Preview file lama --}}
                @if($certification->image)
                    <div class="mb-3 flex items-center gap-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                        @if($isPdf)
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center text-red-500">
                                <i class="ph ph-file-pdf text-2xl"></i>
                            </div>
                        @else
                            <img src="{{ asset('storage/'.$certification->image) }}" class="h-12 rounded-lg border border-slate-200">
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-slate-700 truncate">{{ basename($certification->image) }}</p>
                            <p class="text-xs text-slate-400">{{ $isPdf ? 'PDF Document' : 'Image' }}</p>
                        </div>
                        <a href="{{ asset('storage/'.$certification->image) }}" target="_blank"
                           class="text-xs font-medium text-indigo-600 hover:text-indigo-700">Lihat File</a>
                    </div>
                @endif

                <input type="file" name="image" accept=".pdf,.jpg,.jpeg,.png,.webp"
                       class="form-input file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin mengubah file. Format: PDF, JPG, PNG, WEBP. Maksimal 5MB.</p>
                @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3" class="form-input">{{ old('description', $certification->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('admin.certifications.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">Perbarui</button>
            </div>
        </form>
    </div>
@endsection