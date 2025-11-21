<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Lamaran - {{ $input['company_name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        @page { margin: 0; size: A4; }
        body { 
            background: #525659; 
            -webkit-print-color-adjust: exact; 
        }
        .font-serif { font-family: 'Merriweather', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
        
        .print-area { 
            width: 210mm; 
            min-height: 297mm; 
            padding: 20mm 25mm; 
            margin: 40px auto; 
            background: white; 
            position: relative; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        @media print {
            body { background: white; }
            .no-print { display: none; }
            .print-area { 
                width: 100%; 
                height: 100%; 
                margin: 0; 
                padding: 20mm 25mm;
                box-shadow: none; 
            }
        }

        .content-body p {
            margin-bottom: 1.5em;
            line-height: 1.8;
            text-align: justify;
        }
    </style>
</head>
<body>

    <!-- Tombol Download -->
    <div class="no-print fixed top-6 right-6 z-50 flex gap-3">
        <a href="{{ route('admin.letter.index') }}" class="bg-white text-slate-700 px-4 py-2 rounded-full shadow-lg font-sans font-semibold hover:bg-slate-50 flex items-center gap-2 border border-slate-200 transition">
            <i class="ph-bold ph-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="bg-slate-900 text-white px-6 py-2 rounded-full shadow-lg font-sans font-bold hover:bg-slate-800 flex items-center gap-2 transition transform hover:-translate-y-0.5">
            <i class="ph-bold ph-printer"></i> Simpan PDF / Print
        </button>
    </div>

    <!-- Dokumen Kertas A4 -->
    <div class="print-area text-slate-900">
        
        <!-- HEADER -->
        <header class="border-b-2 border-slate-800 pb-6 mb-8">
            <h1 class="text-3xl font-sans font-bold uppercase tracking-wider text-slate-900 mb-2">{{ $profile->name }}</h1>
            <div class="flex flex-wrap gap-x-6 gap-y-1 text-sm font-sans text-slate-600 font-medium">
                <span class="flex items-center gap-1.5"><i class="ph-fill ph-envelope text-slate-400"></i> {{ $profile->email }}</span>
                @if($profile->linkedin_link)
                    <span class="flex items-center gap-1.5"><i class="ph-fill ph-linkedin-logo text-slate-400"></i> {{ $profile->linkedin_link }}</span>
                @endif
                @if($profile->github_link)
                    <span class="flex items-center gap-1.5"><i class="ph-fill ph-github-logo text-slate-400"></i> {{ $profile->github_link }}</span>
                @endif
            </div>
        </header>

        <!-- Tanggal & Tujuan (UPDATE: Menampilkan Alamat) -->
        <div class="flex justify-between items-start mb-10 font-serif text-sm">
            <!-- Kiri: Kepada -->
            <div class="max-w-[60%]">
                <p class="text-slate-500 mb-1">Kepada Yth,</p>
                <p class="font-bold text-base text-slate-900">{{ $input['recipient_name'] }}</p>
                <p class="font-bold text-slate-700">{{ $input['company_name'] }}</p>
                <p class="text-slate-600 mt-1 leading-relaxed">{{ $input['company_address'] }}</p>
            </div>

            <!-- Kanan: Tanggal -->
            <div class="text-right">
                <p class="text-slate-900 font-semibold">{{ $date }}</p>
            </div>
        </div>

        <!-- Isi Surat -->
        <div class="font-serif text-[10.5pt] text-slate-800 content-body leading-relaxed">
            @foreach(explode("\n", $content) as $paragraph)
                @if(trim($paragraph) != "")
                    <p>{{ trim($paragraph) }}</p>
                @endif
            @endforeach
        </div>

        <!-- Penutup & Tanda Tangan -->
        <div class="mt-16 font-serif text-sm">
            <p class="mb-12">Hormat Saya,</p>
            
            <div class="relative inline-block">
                <div class="h-16 w-40 border-b border-slate-300 mb-2"></div> 
                <p class="font-bold text-slate-900 text-base">{{ $profile->name }}</p>
            </div>
        </div>

    </div>

</body>
</html>