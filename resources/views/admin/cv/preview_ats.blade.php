<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CV - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page { margin: 0; size: A4; }
        body { font-family: 'Times New Roman', serif; background: white; color: black; }
        .print-area { width: 210mm; min-height: 297mm; padding: 15mm; margin: 0 auto; }
        @media print {
            body { -webkit-print-color-adjust: exact; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="no-print fixed top-4 right-4 z-50">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded shadow font-sans font-bold hover:bg-blue-700">Download PDF / Print</button>
    </div>

    <div class="print-area bg-white shadow-lg">
        <!-- Header -->
        <div class="text-center border-b-2 border-black pb-4 mb-4">
            <h1 class="text-3xl font-bold uppercase tracking-wider">{{ $profile->name }}</h1>
            <p class="text-lg mt-1">{{ $profile->headline }}</p>
            <div class="text-sm mt-2 flex justify-center gap-4 text-gray-700">
                <span>{{ $profile->email }}</span>
                <span>•</span>
                <span>{{ $profile->linkedin_link }}</span>
                <span>•</span>
                <span>{{ $profile->github_link }}</span>
            </div>
        </div>

        <!-- Summary -->
        <div class="mb-6">
            <h3 class="font-bold uppercase border-b border-gray-300 mb-2 text-sm">Summary</h3>
            <p class="text-sm leading-relaxed text-justify">{{ $profile->about_text }}</p>
        </div>

        <!-- Experience -->
        <div class="mb-6">
            <h3 class="font-bold uppercase border-b border-gray-300 mb-3 text-sm">Experience</h3>
            @foreach($work_experiences as $exp)
            <div class="mb-4">
                <div class="flex justify-between items-baseline">
                    <h4 class="font-bold">{{ $exp->role }}</h4>
                    <span class="text-sm italic">{{ $exp->period }}</span>
                </div>
                <div class="text-sm font-semibold">{{ $exp->company }}</div>
                <p class="text-sm mt-1 text-justify">{{ $exp->description }}</p>
            </div>
            @endforeach
        </div>

        <!-- Projects -->
        <div class="mb-6">
            <h3 class="font-bold uppercase border-b border-gray-300 mb-3 text-sm">Key Projects</h3>
            @foreach($projects as $project)
            <div class="mb-3">
                <div class="flex justify-between">
                    <h4 class="font-bold text-sm">{{ $project->title }}</h4>
                    <span class="text-xs bg-gray-200 px-1 rounded">{{ $project->category }}</span>
                </div>
                <p class="text-sm mt-1">{{ $project->description }}</p>
                @if($project->link_url)
                <a href="{{ $project->link_url }}" class="text-xs text-blue-800 underline">{{ $project->link_url }}</a>
                @endif
            </div>
            @endforeach
        </div>

        <!-- Education -->
        <div class="mb-6">
            <h3 class="font-bold uppercase border-b border-gray-300 mb-3 text-sm">Education</h3>
            @foreach($educations as $edu)
            <div class="flex justify-between mb-1">
                <div>
                    <span class="font-bold text-sm">{{ $edu->company }}</span> - <span class="text-sm italic">{{ $edu->role }}</span>
                </div>
                <span class="text-sm">{{ $edu->period }}</span>
            </div>
            @endforeach
        </div>

        <!-- Skills -->
        <div class="mb-6">
            <h3 class="font-bold uppercase border-b border-gray-300 mb-3 text-sm">Skills</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                @foreach($skills as $category => $items)
                <div>
                    <span class="font-bold">{{ $category }}:</span> 
                    {{ $items->pluck('name')->implode(', ') }}
                </div>
                @endforeach
            </div>
        </div>

    </div>
</body>
</html>