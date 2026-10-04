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
            background: white;
            color: #111827;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        .print-area {
            width: 100%;
            background: white;
        }

        h2,
        h3 {
            page-break-after: avoid;
        }

        .experience-item {
            page-break-inside: auto;
            margin-bottom: 1rem;
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

<body>

    @include('admin.cv.partials.ats_content')

</body>

</html>