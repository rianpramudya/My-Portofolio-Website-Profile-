<div class="print-area">
    <div class="text-center mb-6">
        <h1 class="font-bold uppercase tracking-tight text-slate-900">{{ $profile->name ?? 'Nama Belum Diisi' }}
        </h1>
        <p class="font-medium text-slate-700">{{ $profile->headline ?? '' }}</p>
        <div class="mt-1 flex flex-wrap justify-center gap-x-3 text-slate-800">
            @php
            $contacts = array_filter([
            $profile->phone ?? null,
            $profile->email ?? null,
            !empty($profile->linkedin_link) ? str_replace(['https://www.', 'https://'], '', $profile->linkedin_link)
            : null,
            !empty($profile->github_link) ? str_replace(['https://www.', 'https://'], '', $profile->github_link) :
            null,
            ]);
            @endphp
            @foreach($contacts as $contact)
            <span>{{ $contact }}</span>
            @if(!$loop->last)
            <span>|</span>
            @endif
            @endforeach
        </div>
    </div>

    {{-- 1. PROFESSIONAL SUMMARY --}}
    <div class="mb-4">
        <h2 class="font-bold uppercase tracking-wider text-slate-900">{{ $cvLabels['summary'] }}</h2>
        <p class="text-justify text-slate-900">{{ $profile->about_text ?? '' }}</p>
    </div>

    {{-- 2. EDUCATION --}}
    <div class="mb-4">
        <h2 class="font-bold uppercase tracking-wider text-slate-900">{{ $cvLabels['education'] }}</h2>
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

    {{-- 3. WORK EXPERIENCE --}}
    <div class="mb-4">
        <h2 class="font-bold uppercase tracking-wider text-slate-900">{{ $cvLabels['experience'] }}</h2>
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

    {{-- 4. ORGANIZATIONAL EXPERIENCE --}}
    @if(count($organizations) > 0)
    <div class="mb-4">
        <h2 class="font-bold uppercase tracking-wider text-slate-900">{{ $cvLabels['organization'] }}</h2>
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

    {{-- 5. PROJECTS --}}
    <div class="mb-4">
        <h2 class="font-bold uppercase tracking-wider text-slate-900">{{ $cvLabels['projects'] }}</h2>
        @foreach($projects as $project)
        <div class="experience-item mb-3">
            <div class="flex justify-between items-start">
                <h3 class="font-bold text-slate-900">
                    {{ $project->title }}
                    <span class="font-normal italic">| {{ $project->category }}</span>
                </h3>
            </div>
            @php
            $projectLink = $project->link_url ?? $project->url ?? $project->github_url ?? $project->demo_url ?? null;
            @endphp
            @if(!empty($projectLink))
            <div class="text-slate-800" style="font-size: 10.5pt;">
                {{ str_replace(['https://www.', 'https://'], '', $projectLink) }}
            </div>
            @endif
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

    {{-- 6. CERTIFICATIONS --}}
    @if(count($certifications) > 0)
    <div class="mb-4">
        <h2 class="font-bold uppercase tracking-wider text-slate-900">{{ $cvLabels['certifications'] }}</h2>
        @foreach($certifications as $cert)
        <div class="experience-item mb-2">
            <div class="flex justify-between items-start">
                <h3 class="font-bold text-slate-900">
                    {{ $cert->title }}
                    <span class="font-normal italic">| {{ $cert->issuer }}</span>
                </h3>
                <span class="font-medium text-slate-800 whitespace-nowrap">{{ $cert->date->locale($cvLocale)->translatedFormat('M Y') }}</span>
            </div>
            @if($cert->credential || $cert->url)
            <div class="text-slate-800 mt-1" style="font-size: 10.5pt;">
                @if($cert->credential)
                <span>{{ $cvLabels['credential'] }}: {{ $cert->credential }}</span>
                @endif
                @if($cert->credential && $cert->url)
                <span class="mx-1">|</span>
                @endif
                @if($cert->url)
                <span>{{ str_replace(['https://www.', 'https://'], '', $cert->url) }}</span>
                @endif
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <div class="mb-4">
        <h2 class="font-bold uppercase tracking-wider text-slate-900">{{ $cvLabels['skills'] }}</h2>
        @php
        $softSkillGroup = collect($skills)->filter(fn($items, $cat) => stripos($cat, 'soft') !== false);
        $technicalSkillGroup = collect($skills)->reject(fn($items, $cat) => stripos($cat, 'soft') !== false);
        @endphp
        <div class="grid grid-cols-2 gap-x-8 text-slate-900">
            <div>
                <h3 class="font-bold uppercase mb-1" style="font-size: 10.5pt;">{{ $cvLabels['technical'] }}</h3>
                <ul class="list-disc pl-5 space-y-0.5">
                    @foreach($technicalSkillGroup as $category => $items)
                    <li><span class="font-bold">{{ $skillCategoryLabels[$category]->name ?? $category }}:</span> {{ $items->pluck('name')->implode(', ') }}
                    </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="font-bold uppercase mb-1" style="font-size: 10.5pt;">{{ $cvLabels['soft'] }}</h3>
                <ul class="list-disc pl-5">
                    @foreach($softSkillGroup as $category => $items)
                    <li>{{ $items->pluck('name')->implode(', ') }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
