<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Service;
use App\Models\Profile; // <--- Penting: Import Model Profile
use App\Models\Certification;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Ambil data profile
        $profile = Profile::first();

        // Keep an empty model for the view; never invent public profile data.
        $profile ??= new Profile;

        // Ambil data proyek & layanan
        $projects = Project::latest()->get();
        $skills = Skill::all()->groupBy('category');
        $services = Service::all();

        // --- MODIFIKASI BAGIAN INI ---

        // 1. Ambil semua pengalaman (untuk counter/statistik di Hero Section)
        $experiences = Experience::all();

        // 2. Pisahkan berdasarkan kategori (untuk timeline di bawah)
        $work_experiences = Experience::where('type', 'work')->latest()->get();
        $educations = Experience::where('type', 'education')->latest()->get();
        $organizations = Experience::where('type', 'organization')->latest()->get();
        $certifications = Certification::orderByDesc('date')->get();

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
            'organizations',
            'certifications'
        ));
    }
}
