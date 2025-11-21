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
        // Ambil data profile (kita ambil baris pertama saja karena single user)
        $profile = Profile::first();

        // Jika profile belum ada (misal database kosong), kita buat object dummy agar tidak error
        if (!$profile) {
            $profile = new Profile([
                'name' => 'Nama Anda',
                'headline' => 'Web Developer',
                'about_text' => 'Halo, selamat datang di website portofolio saya. Silakan login ke admin untuk mengedit ini.',
                'email' => 'email@contoh.com',
            ]);
        }

        // Ambil data lainnya
        $projects = Project::latest()->take(6)->get();
        $skills = Skill::all()->groupBy('category');
        $services = Service::all();
        $experiences = Experience::where('type', 'work')->latest()->get();
        $educations = Experience::where('type', 'education')->latest()->get();

        // Kirim semua variabel ke view 'home'
        return view('home', compact('projects', 'skills', 'services', 'experiences', 'educations', 'profile'));
    }
}