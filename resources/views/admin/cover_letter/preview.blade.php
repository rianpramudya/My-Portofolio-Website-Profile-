<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Lamaran - {{ $input['company_name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        @page { margin: 0; size: A4; }
        body { background: #525659; -webkit-print-color-adjust: exact; }
        .font-serif { font-family: 'Merriweather', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
        
        .print-area { 
            width: 210mm; 
            min-height: 297mm; 
            padding: 25mm; 
            margin: 40px auto; 
            background: white; 
            position: relative; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        @media print {
            body { background: white; }
            .no-print { display: none; }
            .print-area { width: 100%; height: 100%; margin: 0; padding: 20mm 25mm; box-shadow: none; }
        }

        .content-body p { margin-bottom: 1rem; line-height: 1.6; text-align: justify; }
    </style>
</head>
<body>

    <div class="no-print fixed top-6 right-6 z-50 flex gap-3">
        <button onclick="window.close()" class="bg-white text-slate-700 px-4 py-2 rounded-full shadow-lg font-sans font-semibold hover:bg-slate-50 flex items-center gap-2 border border-slate-200 transition">
            <i class="ph-bold ph-x"></i> Tutup
        </button>
        <button onclick="window.print()" class="bg-slate-900 text-white px-6 py-2 rounded-full shadow-lg font-sans font-bold hover:bg-slate-800 flex items-center gap-2 transition transform hover:-translate-y-0.5">
            <i class="ph-bold ph-printer"></i> Simpan PDF / Print
        </button>
    </div>

    <div class="print-area text-slate-900">
        <header class="border-b-2 border-slate-800 pb-5 mb-10">
            <h1 class="text-2xl font-sans font-bold uppercase tracking-widest text-slate-900 mb-2">{{ $profile->name }}</h1>
            <div class="flex flex-wrap gap-x-6 gap-y-2 text-xs font-sans text-slate-600 font-medium">
                <span class="flex items-center gap-1.5"><i class="ph-fill ph-envelope text-slate-400 text-sm"></i> {{ $profile->email }}</span>
                @if($profile->linkedin_link)
                    <span class="flex items-center gap-1.5"><i class="ph-fill ph-linkedin-logo text-slate-400 text-sm"></i> {{ str_replace(['https://www.', 'https://'], '', $profile->linkedin_link) }}</span>
                @endif
                @if($profile->github_link)
                    <span class="flex items-center gap-1.5"><i class="ph-fill ph-github-logo text-slate-400 text-sm"></i> {{ str_replace(['https://www.', 'https://'], '', $profile->github_link) }}</span>
                @endif
            </div>
        </header>

        <div class="flex justify-between items-start mb-10 font-serif text-[11pt]">
            <div class="max-w-[60%] leading-relaxed">
                <p class="mb-1 text-slate-800">Kepada Yth,</p>
                <p class="font-bold text-slate-900">{{ $input['recipient_name'] }}</p>
                <p class="font-bold text-slate-900">{{ $input['company_name'] }}</p>
                <p class="text-slate-800">{{ $input['company_address'] }}</p>
            </div>
            <div class="text-right">
                <p class="text-slate-800">{{ $date }}</p>
            </div>
        </div>

        <div class="font-serif text-[11pt] text-slate-900 content-body">
            @foreach(explode("\n", $content) as $paragraph)
                @if(trim($paragraph) != "")
                    <p>{{ trim($paragraph) }}</p>
                @endif
            @endforeach
        </div>

        <div class="mt-12 font-serif text-[11pt]">
            <p class="mb-24 text-slate-800">Hormat saya,</p> 
            <p class="font-bold text-slate-900 underline underline-offset-4">{{ $profile->name }}</p>
        </div>
    </div>
</body>
</html>