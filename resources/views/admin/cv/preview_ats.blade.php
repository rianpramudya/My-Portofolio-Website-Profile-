<!DOCTYPE html>
<html lang="{{ $cvLocale }}">

<head>
    <meta charset="UTF-8">
    <title>CV ATS - {{ $profile->name ?? 'Nama Belum Diisi' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4;
            margin: 1.5cm;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            background: #f3f4f6;
            color: #111827;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        .print-area {
            width: 210mm;
            min-height: 297mm;
            padding: 1.5cm;
            margin: 20px auto;
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        @media print {

            html,
            body {
                height: auto !important;
                overflow: visible !important;
                background: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .no-print {
                display: none !important;
            }

            .print-area {
                width: 100% !important;
                height: auto !important;
                overflow: visible !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border: none !important;
            }

            h2,
            h3 {
                page-break-after: avoid;
            }

            .experience-item {
                page-break-inside: auto;
                margin-bottom: 1rem;
            }
        }

        h1 {
            font-size: 24pt;
            border: none;
        }

        h2 {
            font-size: 12pt;
            border-bottom: 1px solid #111827;
            margin-bottom: 8pt;
            margin-top: 12pt;
        }

        h3 {
            font-size: 11pt;
        }

        p,
        li,
        span {
            font-size: 10.5pt;
        }
    </style>
</head>

<body class="py-8 print:py-0">

    <div class="no-print fixed top-6 right-6 z-50 flex gap-2">
        <a href="{{ route('admin.cv.index') }}"
            class="bg-slate-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg hover:bg-slate-700 transition">
            Kembali
        </a>
        @include('admin.cv.partials.download_form', ['cvType' => 'ats'])
    </div>

    @include('admin.cv.partials.ats_content')

</body>

</html>
