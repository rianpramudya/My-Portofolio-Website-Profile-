@extends('layouts.public')
@section('title', ($profile->name ?: 'Portfolio') . ($profile->headline ? ' — '.$profile->headline : ''))
@section('content')
@php
    $nameParts = preg_split('/\s+/', trim($profile->name ?? ''), 2);
    $skillCount = $skills->sum(fn($items) => $items->count());
@endphp
<section id="home" class="public-hero shell">
    <div class="hero-copy">
        <p class="overline"><span class="precision-line" aria-hidden="true"></span> PORTFOLIO / PROFIL PROFESIONAL</p>
        <h1>@if($profile->name)<span>{{ $nameParts[0] }}</span>@if(!empty($nameParts[1]))<span class="silver-text">{{ $nameParts[1] }}</span>@endif @else<span>Profil belum tersedia.</span>@endif</h1>
        @if($profile->headline)<p class="hero-role">{{ $profile->headline }}</p>@endif
        @if($profile->about_text)<p class="hero-intro">{{ Str::limit($profile->about_text, 300) }}</p>@else<p class="hero-intro">Informasi profil belum ditambahkan.</p>@endif
        <div class="hero-actions"><a class="public-button" href="#projects">Lihat Proyek <span aria-hidden="true">↗</span></a><a class="public-button outline-button" href="#contact">Hubungi Saya</a></div>
        @if($projects->isNotEmpty() || $skills->isNotEmpty() || $certifications->isNotEmpty())<dl class="hero-index">
            <div><dt>Proyek</dt><dd>{{ str_pad($projects->count(), 2, '0', STR_PAD_LEFT) }}</dd></div>
            <div><dt>Keahlian</dt><dd>{{ str_pad($skillCount, 2, '0', STR_PAD_LEFT) }}</dd></div>
            <div><dt>Sertifikasi</dt><dd>{{ str_pad($certifications->count(), 2, '0', STR_PAD_LEFT) }}</dd></div>
        </dl>@endif
    </div>
    <figure class="hero-portrait media-frame" data-image-frame>
        <div class="portrait-caption"><span>PROFIL</span><span aria-hidden="true">[ 01 ]</span></div>
        @if($profile->avatar)<img src="{{ asset('storage/'.$profile->avatar) }}" alt="Foto profil {{ $profile->name }}" width="700" height="800" fetchpriority="high" data-managed-image>@endif
        <div class="media-fallback" @if($profile->avatar) hidden @endif><span class="portrait-initial">{{ $profile->name ? mb_substr($profile->name, 0, 1) : '—' }}</span><span>Foto profil belum tersedia</span></div>
        <figcaption><span>{{ $profile->name ?: 'Profil' }}</span><span class="corner-cross" aria-hidden="true">+</span></figcaption>
    </figure>
    <a class="hero-scroll" href="#about"><span>JELAJAHI PORTFOLIO</span><span aria-hidden="true">↓</span></a>
</section>

<section id="about" class="public-section shell">
    <div class="section-heading"><div><p class="overline">01 / PROFIL</p><h2>Tentang Saya<span class="heading-dot">.</span></h2></div><span class="section-line" aria-hidden="true"></span></div>
    <div class="about-layout">
        <div class="profile-copy public-prose">@if($profile->about_text)<p>{{ $profile->about_text }}</p>@else<p class="empty-state">Deskripsi profil belum tersedia.</p>@endif
            <div class="profile-links">@if($profile->cv_link)<a class="text-link" href="{{ $profile->cv_link }}" target="_blank" rel="noopener noreferrer">Unduh CV <span aria-hidden="true">↓</span></a>@endif @if($profile->github_link)<a class="text-link" href="{{ $profile->github_link }}" target="_blank" rel="noopener noreferrer">GitHub ↗</a>@endif @if($profile->linkedin_link)<a class="text-link" href="{{ $profile->linkedin_link }}" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a>@endif</div>
        </div>
        <div class="experience-index">
            @foreach(['Pekerjaan' => $work_experiences, 'Pendidikan' => $educations, 'Organisasi' => $organizations] as $label => $items)
            <div class="experience-group"><h3 class="overline">{{ $label }}</h3>
                @forelse($items as $experience)<article class="experience-row"><p class="experience-period">{{ $experience->period }}</p><h4>{{ $experience->role }}</h4><p class="experience-company">{{ $experience->company }}</p><div class="public-prose"><p>{{ $experience->description }}</p></div>@if($experience->cv_descriptions)<details class="content-details"><summary>Detail pengalaman <span aria-hidden="true">+</span></summary><ul class="public-prose">@foreach($experience->cv_descriptions as $point)<li>{{ $point }}</li>@endforeach</ul></details>@endif</article>@empty<p class="empty-state compact-empty">Belum ada data {{ strtolower($label) }}.</p>@endforelse
            </div>@endforeach
        </div>
    </div>
</section>

<section id="projects" class="public-section shell">
    <div class="section-heading"><div><p class="overline">02 / KARYA</p><h2>Proyek<span class="heading-dot">.</span></h2></div><span class="section-line" aria-hidden="true"></span></div>
    <div class="project-index">@forelse($projects as $project)
        <article class="project-entry {{ $loop->first ? 'project-leading' : '' }}">
            <div class="project-media media-frame" data-image-frame>
                @if($project->image)<img src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}" width="1000" height="650" loading="lazy" decoding="async" data-managed-image>@endif
                <div class="media-fallback" @if($project->image) hidden @endif><span class="project-placeholder-symbol" aria-hidden="true">[ {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }} ]</span><span>Gambar proyek belum tersedia</span></div>
                <span class="project-number" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="project-copy"><p class="overline">{{ $project->category }}</p><h3>{{ $project->title }}</h3><div class="public-prose"><p>{{ $project->description }}</p></div>
                @if($project->cv_descriptions)<details class="content-details"><summary>Detail proyek <span aria-hidden="true">+</span></summary><ul class="public-prose">@foreach($project->cv_descriptions as $point)<li>{{ $point }}</li>@endforeach</ul></details>@endif
                @if($project->link_url)<a class="text-link" href="{{ $project->link_url }}" target="_blank" rel="noopener noreferrer">Lihat Proyek <span aria-hidden="true">↗</span></a>@endif
            </div>
        </article>
    @empty<div class="empty-state full-width">Belum ada proyek yang ditambahkan.</div>@endforelse</div>
</section>

<section id="skills" class="public-section shell">
    <div class="section-heading"><div><p class="overline">03 / KOMPETENSI</p><h2>Keahlian<span class="heading-dot">.</span></h2></div><span class="section-line" aria-hidden="true"></span></div>
    <div class="skill-groups">@forelse($skills as $category => $items)<div class="skill-group"><h3>{{ $category }}</h3><div class="skill-list">@foreach($items as $skill)<div class="skill-item"><div class="skill-label"><span>{{ $skill->name }}</span><span class="skill-percent">{{ $skill->proficiency }}<small>%</small></span></div><div class="skill-meter" role="meter" aria-label="Kemahiran {{ $skill->name }}" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ max(0, min(100, $skill->proficiency)) }}"><span style="width: {{ max(0, min(100, $skill->proficiency)) }}%"></span></div></div>@endforeach</div></div>@empty<p class="empty-state full-width">Data keahlian belum tersedia.</p>@endforelse</div>
</section>

<section id="services" class="public-section shell">
    <div class="section-heading"><div><p class="overline">04 / LAYANAN</p><h2>Layanan<span class="heading-dot">.</span></h2></div><span class="section-line" aria-hidden="true"></span></div>
    <div class="service-index">@forelse($services as $service)<article class="service-entry"><span class="service-number" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><h3>{{ $service->title }}</h3><div class="public-prose"><p>{{ $service->description }}</p></div></article>@empty<p class="empty-state">Informasi layanan belum tersedia.</p>@endforelse</div>
</section>

<section id="certifications" class="public-section certificate-section shell">
    <div class="section-heading"><div><p class="overline">05 / KREDENSIAL</p><h2>Sertifikasi<span class="heading-dot">.</span></h2></div><span class="section-line" aria-hidden="true"></span></div>
    <div class="certificate-index">@forelse($certifications as $certificate)
        <article class="certificate-entry" data-certificate-id="{{ $certificate->id }}">
            <div class="certificate-date"><span>{{ $certificate->date->format('Y') }}</span><span>{{ $certificate->date->locale('id')->translatedFormat('d F') }}</span></div>
            <div class="certificate-copy"><p class="overline">{{ $certificate->issuer }}</p><h3>{{ $certificate->title }}</h3>@if($certificate->credential)<p class="credential-id">ID Kredensial: <span>{{ $certificate->credential }}</span></p>@endif
                @if($certificate->description || $certificate->image)<details class="content-details certificate-details"><summary>Detail sertifikasi <span aria-hidden="true">+</span></summary><div class="public-prose">@if($certificate->description)<p>{{ $certificate->description }}</p>@endif
                @if($certificate->image && strtolower(pathinfo($certificate->image, PATHINFO_EXTENSION)) !== 'pdf')<a class="certificate-image media-frame" href="{{ asset('storage/'.$certificate->image) }}" target="_blank" rel="noopener noreferrer" data-image-frame><img src="{{ asset('storage/'.$certificate->image) }}" alt="Dokumen {{ $certificate->title }}" loading="lazy" decoding="async" data-managed-image><span class="media-fallback" hidden>Pratinjau gambar tidak tersedia. Buka dokumen melalui tautan.</span></a>@endif</div></details>@endif
                <div class="certificate-links">@if($certificate->url)<a class="text-link" href="{{ $certificate->url }}" target="_blank" rel="noopener noreferrer">Verifikasi Kredensial ↗</a>@endif @if($certificate->image)<a class="text-link" href="{{ asset('storage/'.$certificate->image) }}" target="_blank" rel="noopener noreferrer">Buka {{ strtolower(pathinfo($certificate->image, PATHINFO_EXTENSION)) === 'pdf' ? 'PDF' : 'Dokumen' }} ↓</a>@endif</div>
            </div><span class="certificate-seal" aria-hidden="true">✧</span>
        </article>
    @empty<p class="empty-state">Belum ada sertifikasi yang ditambahkan.</p>@endforelse</div>
</section>

<section id="contact" class="public-section contact-section shell">
    <div class="section-heading"><div><p class="overline">06 / KONTAK</p><h2>Hubungi Saya<span class="heading-dot">.</span></h2></div><span class="section-line" aria-hidden="true"></span></div>
    <div class="contact-layout"><div class="contact-info"><p class="contact-name">{{ $profile->name }}</p><p class="contact-role">{{ $profile->headline }}</p><dl>@if($profile->email)<div><dt>Email</dt><dd><a href="mailto:{{ $profile->email }}">{{ $profile->email }} ↗</a></dd></div>@endif @if($profile->phone)<div><dt>Telepon</dt><dd><a href="tel:{{ preg_replace('/[^+0-9]/', '', $profile->phone) }}">{{ $profile->phone }} ↗</a></dd></div>@endif</dl><div class="profile-links">@if($profile->github_link)<a class="text-link" href="{{ $profile->github_link }}" target="_blank" rel="noopener noreferrer">GitHub ↗</a>@endif @if($profile->linkedin_link)<a class="text-link" href="{{ $profile->linkedin_link }}" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a>@endif</div>@if(!$profile->email && !$profile->phone)<p class="empty-state compact-empty">Kontak profil belum tersedia. Anda tetap dapat mengirim pesan melalui formulir.</p>@endif</div>
        <form action="{{ route('contact.store') }}" method="POST" class="public-contact-form">
            @csrf
            @if(session('success'))<div class="form-notice" role="status">{{ session('success') }}</div>@endif
            @if($errors->any())<div class="form-notice form-error" role="alert"><p>Pesan belum terkirim. Periksa isian berikut:</p><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <div class="form-row"><div><label for="contact-name">Nama Lengkap</label><input id="contact-name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" maxlength="255" required @error('name') aria-invalid="true" aria-describedby="error-name" @enderror>@error('name')<span class="field-error" id="error-name">{{ $message }}</span>@enderror</div><div><label for="contact-email">Email</label><input id="contact-email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" maxlength="255" required @error('email') aria-invalid="true" aria-describedby="error-email" @enderror>@error('email')<span class="field-error" id="error-email">{{ $message }}</span>@enderror</div></div>
            <label for="contact-message">Pesan</label><textarea id="contact-message" name="message" rows="5" required @error('message') aria-invalid="true" aria-describedby="error-message" @enderror>{{ old('message') }}</textarea>@error('message')<span class="field-error" id="error-message">{{ $message }}</span>@enderror
            <button type="submit" class="public-button">Kirim Pesan <span aria-hidden="true">↗</span></button>
        </form>
    </div>
</section>
@endsection
