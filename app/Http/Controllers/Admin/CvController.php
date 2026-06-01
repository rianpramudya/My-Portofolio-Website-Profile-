<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function index()
    {
        return view('admin.cv.index');
    }

    public function generate(Request $request)
    {
        $type = $request->input('type', 'ats'); // 'ats' atau 'creative'
        
        // --- PERBAIKAN DI SINI ---
        // AMANKAN DATA PROFIL: Jika kosong, buat object dummy sementara agar tidak error blank
        $profile = Profile::first();
        if (!$profile) {
            $profile = new Profile([
                'name' => 'Nama Belum Diisi',
                'headline' => 'Posisi Belum Diisi',
                'about_text' => 'Silakan isi data profil di Dashboard terlebih dahulu.',
                'email' => 'email@contoh.com',
                'linkedin_link' => '-',
                'github_link' => '-'
            ]);
        }
        // -------------------------
        
        $data = [
            'profile' => $profile, // Gunakan variabel $profile yang sudah diamankan
            'experiences' => Experience::orderBy('created_at', 'desc')->get(),
            'educations' => Experience::where('type', 'education')->orderBy('created_at', 'desc')->get(),
            'work_experiences' => Experience::where('type', 'work')->orderBy('created_at', 'desc')->get(),
            'organizations' => Experience::where('type', 'organization')->orderBy('created_at', 'desc')->get(), // INI BARIS BARU ANDA
            'skills' => Skill::all()->groupBy('category'),
            'projects' => Project::all(),
        ];

        if ($type == 'creative') {
            return view('admin.cv.preview_creative', $data);
        }

        return view('admin.cv.preview_ats', $data);
    }
}