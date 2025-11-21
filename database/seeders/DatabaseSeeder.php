<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Skills
        $skills = [
            ['name' => 'Laravel', 'category' => 'Backend', 'proficiency' => 95, 'icon' => 'ph-file-code'],
            ['name' => 'PHP 8.2', 'category' => 'Backend', 'proficiency' => 90, 'icon' => 'ph-code'],
            ['name' => 'MySQL', 'category' => 'Backend', 'proficiency' => 85, 'icon' => 'ph-database'],
            ['name' => 'React.js', 'category' => 'Frontend', 'proficiency' => 75, 'icon' => 'ph-atom'],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'proficiency' => 90, 'icon' => 'ph-paint-brush'],
            ['name' => 'Docker', 'category' => 'DevOps', 'proficiency' => 70, 'icon' => 'ph-container'],
            ['name' => 'Git', 'category' => 'Tools', 'proficiency' => 88, 'icon' => 'ph-git-branch'],
        ];
        foreach ($skills as $skill) Skill::create($skill);

        // 2. Seed Services
        $services = [
            [
                'title' => 'Web Development',
                'description' => 'Membangun aplikasi web yang cepat, responsif, dan scalable menggunakan Laravel & React.',
                'icon' => 'ph-desktop',
            ],
            [
                'title' => 'API Development',
                'description' => 'Merancang RESTful API yang aman dan terdokumentasi dengan baik untuk kebutuhan Mobile & Frontend.',
                'icon' => 'ph-brackets-curly',
            ],
            [
                'title' => 'Database Design',
                'description' => 'Optimalisasi struktur database untuk performa tinggi dan integritas data yang kuat.',
                'icon' => 'ph-database',
            ],
        ];
        foreach ($services as $service) Service::create($service);

        // 3. Seed Experiences
        $experiences = [
            [
                'role' => 'Senior Backend Developer',
                'company' => 'Tech Unicorn Indonesia',
                'period' => '2023 - Sekarang',
                'description' => 'Memimpin tim backend beranggotakan 5 orang, merancang arsitektur microservices, dan meningkatkan performa API sebesar 40%.',
                'type' => 'work'
            ],
            [
                'role' => 'Fullstack Developer',
                'company' => 'Creative Digital Agency',
                'period' => '2021 - 2023',
                'description' => 'Mengerjakan berbagai proyek klien mulai dari E-Commerce hingga Company Profile menggunakan Laravel dan Vue.js.',
                'type' => 'work'
            ],
            [
                'role' => 'S1 Teknik Informatika',
                'company' => 'Universitas Teknologi',
                'period' => '2017 - 2021',
                'description' => 'Lulus dengan predikat Cum Laude. Fokus penelitian pada keamanan sistem informasi.',
                'type' => 'education'
            ]
        ];
        foreach ($experiences as $exp) Experience::create($exp);

        // 4. Seed Projects (Hapus data lama jika ada)
        Project::truncate();
        Project::create([
            'title' => 'Sistem Manajemen Rumah Sakit',
            'category' => 'Web App',
            'description' => 'Platform terintegrasi untuk pendaftaran pasien, rekam medis elektronik, dan manajemen farmasi.',
            'image' => null, // Akan pakai placeholder di view
            'link_url' => 'https://github.com/rian/rs-system',
        ]);
        Project::create([
            'title' => 'E-Commerce API Gateway',
            'category' => 'Backend',
            'description' => 'Layanan penghubung pembayaran (Payment Gateway) dan logistik dengan sistem keamanan JWT.',
            'image' => null,
            'link_url' => 'https://github.com/rian/ecommerce-api',
        ]);
    }
}