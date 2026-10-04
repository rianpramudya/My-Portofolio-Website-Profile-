<!DOCTYPE html>
<html lang="{{ $cvLocale }}">

<head>
    <meta charset="UTF-8">
    <title>Creative CV - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        @page {
            margin: 0;
            size: A4;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #e5e7eb;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .print-area {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            display: flex;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none;
            }

            .print-area {
                box-shadow: none;
                margin: 0;
                width: 210mm;
                height: 297mm;
                page-break-after: always;
            }
        }
    </style>
</head>

<body class="py-10 print:py-0 flex justify-center">

    <div class="no-print fixed top-6 right-6 z-50">
        @include('admin.cv.partials.download_form', ['cvType' => 'creative'])
    </div>

    @include('admin.cv.partials.creative_content')

</body>

</html>
