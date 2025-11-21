@extends('layouts.admin')

@section('header', 'Kotak Masuk (Inbox)')

@section('content')
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="bg-indigo-100 text-indigo-600 w-8 h-8 rounded-lg flex items-center justify-center">
                <i class="ph-bold ph-envelope-simple"></i>
            </div>
            <h3 class="font-bold text-slate-800">Daftar Pesan Masuk</h3>
        </div>
        <span class="text-xs font-medium text-slate-500 bg-white px-2 py-1 rounded border border-slate-200">
            Total: {{ $contacts->count() }} Pesan
        </span>
    </div>
    
    <div class="divide-y divide-slate-100">
        @forelse($contacts as $contact)
        <!-- Logika Style: Jika belum dibaca (is_read == false), background putih terang & border kiri biru -->
        <div class="p-6 transition group {{ $contact->is_read ? 'bg-slate-50/50 opacity-75 hover:opacity-100' : 'bg-white border-l-4 border-indigo-500' }}">
            <div class="flex justify-between items-start mb-2">
                <div class="flex items-center gap-3">
                    <!-- Avatar Inisial -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-sm {{ $contact->is_read ? 'bg-slate-400' : 'bg-gradient-to-br from-indigo-500 to-purple-500' }}">
                        {{ substr($contact->name, 0, 1) }}
                    </div>
                    
                    <div>
                        <h4 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                            {{ $contact->name }}
                            @if(!$contact->is_read)
                                <span class="bg-red-100 text-red-600 text-[10px] px-2 py-0.5 rounded-full font-extrabold">BARU</span>
                            @endif
                        </h4>
                        <p class="text-xs text-slate-500">{{ $contact->email }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="text-xs text-slate-400 flex items-center gap-1" title="{{ $contact->created_at }}">
                        <i class="ph-fill ph-clock"></i> {{ $contact->created_at->diffForHumans() }}
                    </span>
                    
                    <!-- Tombol Tandai Dibaca -->
                    @if(!$contact->is_read)
                        <form action="{{ route('admin.contacts.markRead', $contact->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition" title="Tandai sudah dibaca">
                                <i class="ph-bold ph-check-circle text-lg"></i>
                            </button>
                        </form>
                    @endif

                    <!-- Tombol Hapus -->
                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')" class="opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-slate-400 hover:text-red-500 p-2 hover:bg-red-50 rounded-lg transition" title="Hapus Pesan">
                            <i class="ph-bold ph-trash text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="ml-13 pl-3 border-l-2 {{ $contact->is_read ? 'border-slate-200' : 'border-indigo-100' }}">
                <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-wrap font-{{ $contact->is_read ? 'normal' : 'medium' }}">{{ $contact->message }}</p>
            </div>
        </div>
        @empty
        <div class="p-12 text-center">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                <i class="ph-duotone ph-tray text-3xl"></i>
            </div>
            <p class="text-slate-500 font-medium">Belum ada pesan masuk.</p>
            <p class="text-xs text-slate-400">Pesan dari formulir kontak akan muncul di sini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection