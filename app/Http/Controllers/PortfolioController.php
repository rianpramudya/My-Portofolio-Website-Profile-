<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Service;
use App\Models\Profile; // <--- Penting: Import Model Profile
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Ambil data profile
        $profile = Profile::first();

        if (!$profile) {
            $profile = new Profile([
                'name' => 'Rian Pramudya Amanda',
                'headline' => 'Full Stack Web Developer',
                'about_text' => 'Halo, selamat datang di website portofolio saya.',
                'email' => 'pramudyaamanda88@gmail.com',
            ]);
        }

        // Ambil data proyek & layanan
        $projects = Project::latest()->take(6)->get();
        $skills = Skill::all()->groupBy('category');
        $services = Service::all();

        // --- MODIFIKASI BAGIAN INI ---

        // 1. Ambil semua pengalaman (untuk counter/statistik di Hero Section)
        $experiences = Experience::all();

        // 2. Pisahkan berdasarkan kategori (untuk timeline di bawah)
        $work_experiences = Experience::where('type', 'work')->latest()->get();
        $educations = Experience::where('type', 'education')->latest()->get();
        $organizations = Experience::where('type', 'organization')->latest()->get();

        // -----------------------------

        // Kirim semua variabel ke view 'home'
        return view('home', compact(
            'projects',
            'skills',
            'services',
            'profile',
            'experiences',        // Untuk statistik "+ Posisi Kerja"
            'work_experiences',   // Untuk timeline pekerjaan
            'educations',         // Untuk timeline pendidikan
            'organizations'       // Untuk timeline organisasi
        ));
    }
}
