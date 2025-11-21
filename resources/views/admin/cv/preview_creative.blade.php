<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Creative CV - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        @page { margin: 0; size: A4; }
        body { font-family: 'Poppins', sans-serif; background: #e5e7eb; -webkit-print-color-adjust: exact; }
        .print-area { width: 210mm; min-height: 297mm; margin: 0 auto; background: white; display: flex; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        @media print {
            body { background: white; }
            .no-print { display: none; }
            .print-area { box-shadow: none; margin: 0; width: 100%; height: 100%; }
        }
    </style>
</head>
<body class="py-10 print:py-0">

    <!-- Tombol Download -->
    <div class="no-print fixed top-6 right-6 z-50">
        <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-3 rounded-full shadow-xl font-bold hover:bg-indigo-700 flex items-center gap-2 transition transform hover:scale-105">
            <i class="ph-bold ph-download-simple"></i> Save as PDF
        </button>
    </div>

    <div class="print-area">
        
        <!-- KOLOM KIRI (Sidebar Gelap/Berwarna) -->
        <div class="w-1/3 bg-slate-900 text-white p-8 flex flex-col gap-8">
            
            <!-- Foto Profil -->
            <div class="text-center">
                <div class="w-32 h-32 mx-auto bg-white rounded-full overflow-hidden border-4 border-indigo-500 mb-4 relative">
                    @if($profile->avatar)
                        <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400 text-4xl">
                            <i class="ph-fill ph-user"></i>
                        </div>
                    @endif
                </div>
                <h2 class="text-xl font-bold leading-tight">{{ $profile->name }}</h2>
                <p class="text-indigo-400 text-sm mt-1 uppercase tracking-wider font-semibold">{{ $profile->headline }}</p>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="text-lg font-bold border-b border-slate-700 pb-2 mb-4 uppercase text-slate-300">Contact</h3>
                <ul class="space-y-3 text-sm text-slate-300">
                    <li class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-800 rounded-full flex items-center justify-center text-indigo-400 flex-shrink-0"><i class="ph-fill ph-envelope"></i></div>
                        <span class="break-all">{{ $profile->email }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-800 rounded-full flex items-center justify-center text-indigo-400 flex-shrink-0"><i class="ph-fill ph-linkedin-logo"></i></div>
                        <span class="truncate">LinkedIn Profile</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-slate-800 rounded-full flex items-center justify-center text-indigo-400 flex-shrink-0"><i class="ph-fill ph-github-logo"></i></div>
                        <span class="truncate">GitHub Profile</span>
                    </li>
                </ul>
            </div>

            <!-- Skills -->
            <div class="flex-1">
                <h3 class="text-lg font-bold border-b border-slate-700 pb-2 mb-4 uppercase text-slate-300">Skills</h3>
                <div class="space-y-4">
                    @foreach($skills as $category => $items)
                    <div>
                        <h4 class="text-xs font-bold text-indigo-400 uppercase mb-2">{{ $category }}</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($items as $skill)
                            <span class="px-2 py-1 bg-slate-800 rounded text-xs font-medium">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN (Konten Utama Putih) -->
        <div class="w-2/3 p-10 bg-white text-slate-800">
            
            <!-- Profile Summary -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-slate-900 border-b-2 border-indigo-500 pb-2 mb-3 uppercase tracking-wide">Profile</h3>
                <p class="text-sm text-slate-600 leading-relaxed text-justify">
                    {{ $profile->about_text }}
                </p>
            </div>

            <!-- Experience -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-slate-900 border-b-2 border-indigo-500 pb-2 mb-4 uppercase tracking-wide">Experience</h3>
                <div class="space-y-5">
                    @foreach($work_experiences as $exp)
                    <div class="relative pl-4 border-l-2 border-indigo-100">
                        <div class="absolute -left-[5px] top-1.5 w-2.5 h-2.5 bg-indigo-500 rounded-full"></div>
                        <div class="flex justify-between items-baseline mb-1">
                            <h4 class="font-bold text-slate-800">{{ $exp->role }}</h4>
                            <span class="text-xs font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded">{{ $exp->period }}</span>
                        </div>
                        <div class="text-sm font-semibold text-slate-500 mb-2">{{ $exp->company }}</div>
                        <p class="text-sm text-slate-600 leading-relaxed text-justify">{{ $exp->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Education -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-slate-900 border-b-2 border-indigo-500 pb-2 mb-4 uppercase tracking-wide">Education</h3>
                <div class="space-y-4">
                    @foreach($educations as $edu)
                    <div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-slate-800">{{ $edu->company }}</h4>
                            <span class="text-xs text-slate-500">{{ $edu->period }}</span>
                        </div>
                        <p class="text-sm text-indigo-600 font-medium">{{ $edu->role }}</p>
                        <p class="text-xs text-slate-500 mt-1">{{ $edu->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Projects (Optional Grid) -->
            <div>
                <h3 class="text-xl font-bold text-slate-900 border-b-2 border-indigo-500 pb-2 mb-4 uppercase tracking-wide">Projects</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($projects->take(4) as $project)
                    <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
                        <h4 class="font-bold text-sm text-slate-800">{{ $project->title }}</h4>
                        <p class="text-xs text-indigo-500 font-bold mb-1">{{ $project->category }}</p>
                        <p class="text-xs text-slate-500 line-clamp-2">{{ $project->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

</body>
</html>