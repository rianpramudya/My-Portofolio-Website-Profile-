@extends('layouts.admin')

@section('title', 'Sertifikasi')
@section('header', 'Sertifikasi')

@section('content')
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-base font-semibold text-slate-800">Daftar Sertifikasi</h2>
            <a href="{{ route('admin.certifications.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200">
                <i class="ph ph-plus"></i> Tambah Sertifikasi
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 text-slate-500 font-medium">
                    <tr>
                        <th class="px-5 py-3">Sertifikasi</th>
                        <th class="px-5 py-3">Penerbit</th>
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($certifications as $cert)
                        @php
                            $ext = $cert->image ? Str::lower(pathinfo($cert->image, PATHINFO_EXTENSION)) : null;
                            $isPdf = $ext === 'pdf';
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    {{-- Thumbnail: Gambar atau Icon PDF --}}
                                    @if($cert->image)
                                        @if($isPdf)
                                            <a href="{{ asset('storage/'.$cert->image) }}" target="_blank"
                                               class="w-10 h-10 rounded-lg bg-red-50 border border-red-100 flex items-center justify-center text-red-500 hover:bg-red-100 transition-colors">
                                                <i class="ph ph-file-pdf text-xl"></i>
                                            </a>
                                        @else
                                            <img src="{{ asset('storage/'.$cert->image) }}" alt="" class="w-10 h-10 rounded-lg object-cover border border-slate-200">
                                        @endif
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                            <i class="ph ph-certificate text-lg"></i>
                                        </div>
                                    @endif

                                    <div>
                                        <div class="font-medium text-slate-800">{{ $cert->title }}</div>
                                        @if($cert->credential)
                                            <div class="text-xs text-slate-400">ID: {{ $cert->credential }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ $cert->issuer }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $cert->date->format('M Y') }}</td>
                            <td class="px-5 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    {{-- Preview/Download --}}
                                    @if($cert->image)
                                        <a href="{{ asset('storage/'.$cert->image) }}" target="_blank"
                                           class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                           title="Lihat File">
                                            <i class="ph ph-eye text-base"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.certifications.edit', $cert) }}"
                                       class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                        <i class="ph ph-pencil-simple text-base"></i>
                                    </a>
                                    <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus sertifikasi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <i class="ph ph-trash text-base"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center text-slate-400">
                                <i class="ph ph-certificate text-3xl mb-2 block"></i>
                                Belum ada sertifikasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($certifications->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $certifications->links() }}
            </div>
        @endif
    </div>
@endsection