<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Creative CV - {{ $profile->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        @page { margin: 0; size: A4; }
        body { font-family: 'Poppins', sans-serif; background: #e5e7eb; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .print-area { width: 210mm; min-height: 297mm; margin: 0 auto; background: white; display: flex; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        @media print {
            body { background: white; margin: 0; padding: 0; }
            .no-print { display: none; }
            .print-area { box-shadow: none; margin: 0; width: 210mm; height: 297mm; page-break-after: always; }
        }
    </style>
</head>
<body class="py-10 print:py-0 flex justify-center">

    <div class="no-print fixed top-6 right-6 z-50">
        <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-3 rounded-full shadow-xl font-bold hover:bg-indigo-700 flex items-center gap-2 transition transform hover:-translate-y-1">
            <i class="ph-bold ph-printer"></i> Save / Print CV
        </button>
    </div>

    <div class="print-area">
        
        <div class="w-[35%] bg-slate-900 text-white p-8 flex flex-col gap-8">
            <div class="text-center">
                <div class="w-32 h-32 mx-auto bg-white rounded-full overflow-hidden border-4 border-indigo-500 mb-4 relative flex items-center justify-center">
                    @if($profile->avatar)
                        <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <i class="ph-fill ph-user text-slate-300 text-5xl"></i>
                    @endif
                </div>
                <h2 class="text-2xl font-bold leading-tight">{{ $profile->name }}</h2>
                <p class="text-indigo-400 text-[10px] mt-1.5 uppercase tracking-widest font-semibold">{{ $profile->headline }}</p>
            </div>

            <div>
                <h3 class="text-sm font-bold border-b border-slate-700 pb-2 mb-4 uppercase tracking-widest text-slate-300">Contact</h3>
                <ul class="space-y-4 text-[11px] text-slate-300">
                    <li class="flex items-center gap-3">
                        <div class="w-7 h-7 bg-slate-800 rounded-md flex items-center justify-center text-indigo-400 flex-shrink-0"><i class="ph-fill ph-envelope"></i></div>
                        <span class="break-all">{{ $profile->email }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-7 h-7 bg-slate-800 rounded-md flex items-center justify-center text-indigo-400 flex-shrink-0"><i class="ph-fill ph-linkedin-logo"></i></div>
                        <span class="truncate">{{ str_replace(['https://www.linkedin.com/in/', 'https://linkedin.com/in/'], '', $profile->linkedin_link) }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-7 h-7 bg-slate-800 rounded-md flex items-center justify-center text-indigo-400 flex-shrink-0"><i class="ph-fill ph-github-logo"></i></div>
                        <span class="truncate">{{ str_replace(['https://github.com/', 'http://github.com/'], '', $profile->github_link) }}</span>
                    </li>
                </ul>
            </div>

            <div class="flex-1">
                <h3 class="text-sm font-bold border-b border-slate-700 pb-2 mb-4 uppercase tracking-widest text-slate-300">Skills</h3>
                <div class="space-y-5">
                    @foreach($skills as $category => $items)
                    <div>
                        <h4 class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider mb-2">{{ $category }}</h4>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($items as $skill)
                            <span class="px-2 py-1 bg-slate-800 rounded text-[10px] font-medium text-slate-200">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-[65%] p-10 bg-white text-slate-800">
            
            <div class="mb-7">
                <h3 class="text-lg font-bold text-slate-900 border-b-2 border-indigo-100 pb-1.5 mb-3 uppercase tracking-wider flex items-center gap-2">
                    <i class="ph-fill ph-user-circle text-indigo-500"></i> Profile
                </h3>
                <p class="text-sm text-slate-600 leading-relaxed text-justify">{{ $profile->about_text }}</p>
            </div>

            <div class="mb-7">
                <h3 class="text-lg font-bold text-slate-900 border-b-2 border-indigo-100 pb-1.5 mb-4 uppercase tracking-wider flex items-center gap-2">
                    <i class="ph-fill ph-briefcase text-indigo-500"></i> Experience
                </h3>
                <div class="space-y-5">
                    @foreach($work_experiences as $exp)
                    <div class="relative pl-5 border-l-2 border-indigo-200">
                        <div class="absolute -left-[7px] top-1.5 w-3 h-3 bg-white border-2 border-indigo-500 rounded-full"></div>
                        <div class="flex justify-between items-baseline mb-0.5">
                            <h4 class="font-bold text-slate-800 text-sm">{{ $exp->role }}</h4>
                            <span class="text-[10px] font-bold text-indigo-700 bg-indigo-50 px-2 py-1 rounded-md">{{ $exp->period }}</span>
                        </div>
                        <div class="text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wide">{{ $exp->company }}</div>
                        
                        @if(!empty($exp->cv_descriptions) && is_array($exp->cv_descriptions) && count($exp->cv_descriptions) > 0)
                            <ul class="list-disc pl-3 text-xs text-slate-600 space-y-0.5 leading-relaxed">
                                @foreach($exp->cv_descriptions as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-xs text-slate-600 leading-relaxed text-justify">{{ $exp->description }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            @if(count($organizations) > 0)
            <div class="mb-7">
                <h3 class="text-lg font-bold text-slate-900 border-b-2 border-indigo-100 pb-1.5 mb-4 uppercase tracking-wider flex items-center gap-2">
                    <i class="ph-fill ph-users-three text-indigo-500"></i> Organization
                </h3>
                <div class="space-y-5">
                    @foreach($organizations as $org)
                    <div class="relative pl-5 border-l-2 border-indigo-200">
                        <div class="absolute -left-[7px] top-1.5 w-3 h-3 bg-white border-2 border-indigo-500 rounded-full"></div>
                        <div class="flex justify-between items-baseline mb-0.5">
                            <h4 class="font-bold text-slate-800 text-sm">{{ $org->role }}</h4>
                            <span class="text-[10px] font-bold text-indigo-700 bg-indigo-50 px-2 py-1 rounded-md">{{ $org->period }}</span>
                        </div>
                        <div class="text-[11px] font-semibold text-slate-500 mb-2 uppercase tracking-wide">{{ $org->company }}</div>
                        
                        @if(!empty($org->cv_descriptions) && is_array($org->cv_descriptions) && count($org->cv_descriptions) > 0)
                            <ul class="list-disc pl-3 text-xs text-slate-600 space-y-0.5 leading-relaxed">
                                @foreach($org->cv_descriptions as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-xs text-slate-600 leading-relaxed text-justify">{{ $org->description }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif  

            <div class="mb-7">
    <h3 class="text-lg font-bold text-slate-900 border-b-2 border-indigo-100 pb-1.5 mb-4 uppercase tracking-wider flex items-center gap-2">
        <i class="ph-fill ph-graduation-cap text-indigo-500"></i> Education
    </h3>
    <div class="space-y-4">
        @foreach($educations as $edu)
        <div class="bg-slate-50 p-3 rounded-lg border border-slate-100">
            <div class="flex justify-between items-center mb-1">
                <h4 class="font-bold text-slate-800 text-sm">{{ $edu->company }}</h4>
                <span class="text-xs text-slate-500 font-medium">{{ $edu->period }}</span>
            </div>
            <p class="text-sm text-indigo-600 font-semibold">{{ $edu->role }}</p>
            
            {{-- TAMBAHKAN LOGIKA INI --}}
            @if(!empty($edu->cv_descriptions) && is_array($edu->cv_descriptions) && count($edu->cv_descriptions) > 0)
                <ul class="list-disc pl-4 text-xs mt-2 text-slate-600 space-y-1">
                    @foreach($edu->cv_descriptions as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            @elseif($edu->description)
                <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">{{ $edu->description }}</p>
            @endif
        </div>
        @endforeach
    </div>
</div>

            <div>
                <h3 class="text-lg font-bold text-slate-900 border-b-2 border-indigo-100 pb-1.5 mb-4 uppercase tracking-wider flex items-center gap-2">
                    <i class="ph-fill ph-rocket-launch text-indigo-500"></i> Key Projects
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($projects->take(4) as $project)
                    <div class="p-0">
                        <h4 class="font-bold text-xs text-slate-800 leading-tight mb-1">{{ $project->title }}</h4>
                        <p class="text-[9px] text-indigo-500 font-bold uppercase tracking-wider mb-1.5">{{ $project->category }}</p>
                        
                        @if(!empty($project->cv_descriptions) && is_array($project->cv_descriptions) && count($project->cv_descriptions) > 0)
                            <ul class="list-disc pl-3 text-[10px] text-slate-600 space-y-0.5 leading-relaxed">
                                @foreach($project->cv_descriptions as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-[10px] text-slate-600 line-clamp-3 leading-relaxed">{{ $project->description }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</body>
</html>