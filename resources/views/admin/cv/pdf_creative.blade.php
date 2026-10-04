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
            background: white;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .print-area {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            display: flex;
        }
    </style>
</head>

<body>

    @include('admin.cv.partials.creative_content')

</body>

</html>