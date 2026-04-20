<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CV ATS - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* 1. Pengaturan Kertas Formal (A4) */
        @page {
            size: A4;
            /* Memberikan margin 1.5cm di setiap sisi kertas (Atas, Bawah, Kiri, Kanan) */
            margin: 1.5cm; 
        }

        /* 2. Pengaturan Font & Tampilan Dasar */
        body {
            /* Menggunakan Times New Roman sesuai permintaan */
            font-family: "Times New Roman", Times, serif;
            background: #f3f4f6;
            color: #111827;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        /* Area Tampilan di Browser */
        .print-area {
            width: 210mm;
            min-height: 297mm;
            padding: 1.5cm; /* Menyamakan padding preview dengan margin print */
            margin: 20px auto;
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* 3. Logika Khusus Cetak/Save PDF */
        @media print {
            body {
                background: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .no-print {
                display: none !important;
            }

            .print-area {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important; /* Padding dinonaktifkan karena sudah ada margin @page */
                box-shadow: none !important;
                border: none !important;
            }

            /* Mencegah judul terpisah dari kontennya di akhir halaman */
            h2, h3 { 
                page-break-after: avoid; 
            }

            /* Memastikan blok pengalaman tidak terpotong di tengah kalimat jika memungkinkan */
            .experience-item {
                page-break-inside: auto;
                margin-bottom: 1rem;
            }
        }

        /* Tipografi ATS */
        h1 { font-size: 24pt; border: none; }
        h2 { font-size: 12pt; border-bottom: 1px solid #111827; margin-bottom: 8pt; margin-top: 12pt; }
        h3 { font-size: 11pt; }
        p, li, span { font-size: 10.5pt; }
    </style>
</head>
<body class="py-8 print:py-0">

    <div class="no-print fixed top-6 right-6 z-50 flex gap-2">
        <a href="{{ route('admin.cv.index') }}" class="bg-slate-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg hover:bg-slate-700 transition">
            Kembali
        </a>
        <button onclick="window.print()"
            class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow-lg font-bold hover:bg-indigo-700 transition text-sm">
            Download PDF / Print
        </button>
    </div>

    <div class="print-area">
        <div class="text-center mb-6">
            <h1 class="font-bold uppercase tracking-tight text-slate-900">{{ $profile->name }}</h1>
            <p class="font-medium text-slate-700">{{ $profile->headline }}</p>
            <div class="mt-1 flex flex-wrap justify-center gap-x-3 text-slate-800">
                <span>{{ $profile->email }}</span>
                <span>|</span>
                <span>{{ str_replace(['https://www.', 'https://'], '', $profile->linkedin_link) }}</span>
                <span>|</span>
                <span>{{ str_replace(['https://www.', 'https://'], '', $profile->github_link) }}</span>
            </div>
        </div>

        <div class="mb-4">
            <h2 class="font-bold uppercase tracking-wider text-slate-900">Professional Summary</h2>
            <p class="text-justify text-slate-900">{{ $profile->about_text }}</p>
        </div>

        <div class="mb-4">
            <h2 class="font-bold uppercase tracking-wider text-slate-900">Work Experience</h2>
            @foreach($work_experiences as $exp)
            <div class="experience-item mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-slate-900">{{ $exp->role }}</h3>
                        <div class="font-bold text-slate-800">{{ $exp->company }}</div>
                    </div>
                    <span class="font-medium text-slate-800 whitespace-nowrap">{{ $exp->period }}</span>
                </div>
                @if(!empty($exp->cv_descriptions) && is_array($exp->cv_descriptions))
                <ul class="list-disc pl-5 mt-1 text-slate-900 space-y-0.5">
                    @foreach($exp->cv_descriptions as $point)
                    <li>{{ $point }}</li>
                    @endforeach
                </ul>
                @else
                <p class="mt-1 text-justify text-slate-900">{{ $exp->description }}</p>
                @endif
            </div>
            @endforeach
        </div>

        @if(count($organizations) > 0)
        <div class="mb-4">
            <h2 class="font-bold uppercase tracking-wider text-slate-900">Organizational Experience</h2>
            @foreach($organizations as $org)
            <div class="experience-item mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-slate-900">{{ $org->role }}</h3>
                        <div class="font-bold text-slate-800">{{ $org->company }}</div>
                    </div>
                    <span class="font-medium text-slate-800 whitespace-nowrap">{{ $org->period }}</span>
                </div>
                @if(!empty($org->cv_descriptions) && is_array($org->cv_descriptions))
                <ul class="list-disc pl-5 mt-1 text-slate-900 space-y-0.5">
                    @foreach($org->cv_descriptions as $point)
                    <li>{{ $point }}</li>
                    @endforeach
                </ul>
                @else
                <p class="mt-1 text-justify text-slate-900">{{ $org->description }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @endif

        <div class="mb-4">
            <h2 class="font-bold uppercase tracking-wider text-slate-900">Key Projects</h2>
            @foreach($projects as $project)
            <div class="experience-item mb-3">
                <div class="flex justify-between items-start">
                    <h3 class="font-bold text-slate-900">
                        {{ $project->title }} 
                        <span class="font-normal italic">| {{ $project->category }}</span>
                    </h3>
                </div>
                @if(!empty($project->cv_descriptions) && is_array($project->cv_descriptions))
                <ul class="list-disc pl-5 mt-1 text-slate-900 space-y-0.5">
                    @foreach($project->cv_descriptions as $point)
                    <li>{{ $point }}</li>
                    @endforeach
                </ul>
                @else
                <p class="mt-1 text-justify text-slate-900">{{ $project->description }}</p>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mb-4">
            <h2 class="font-bold uppercase tracking-wider text-slate-900">Education</h2>
            @foreach($educations as $edu)
            <div class="experience-item mb-2">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-slate-900">{{ $edu->company }}</h3>
                        <div class="italic text-slate-800">{{ $edu->role }}</div>
                    </div>
                    <span class="font-medium text-slate-800 whitespace-nowrap">{{ $edu->period }}</span>
                </div>
                @if(!empty($edu->cv_descriptions) && is_array($edu->cv_descriptions))
                <ul class="list-disc pl-5 mt-1 text-slate-900 space-y-0.5">
                    @foreach($edu->cv_descriptions as $point)
                    <li>{{ $point }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mb-4">
            <h2 class="font-bold uppercase tracking-wider text-slate-900">Core Skills & Competencies</h2>
            <div class="text-slate-900">
                @foreach($skills as $category => $items)
                <div class="mb-1">
                    <span class="font-bold">{{ $category }}:</span> {{ $items->pluck('name')->implode(', ') }}
                </div>
                @endforeach
            </div>
        </div>
    </div>

</body>
</html>