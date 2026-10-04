<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // Halaman Utama Dashboard
    public function index()
    {
        $projectCount = Project::count();
        $experienceCount = Experience::count();
        
        // Ambil data profile pertama, jika tidak ada buat baru (firstOrCreate)
        $profile = Profile::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Nama Anda',
                'headline' => 'Web Developer',
                'about_text' => 'Deskripsi singkat...',
                'email' => 'email@anda.com',
                'phone' => '081234567890', // <--- Default nomor HP jika baru pertama buat
            ]
        );

        return view('admin.dashboard', compact('profile', 'projectCount', 'experienceCount'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'headline' => 'sometimes|required|string|max:255',
            'about_text' => 'sometimes|required|string',
            'email' => 'nullable|email|max:255',
            'cv_link' => 'nullable|url|max:2048',
            'github_link' => 'nullable|url|max:2048',
            'linkedin_link' => 'nullable|url|max:2048',
            'phone'  => 'nullable|string|max:20', // <--- Tambahkan validasi phone
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile = Profile::first() ?? new Profile([
            'headline' => 'Web Developer',
            'about_text' => 'Deskripsi singkat...',
        ]);

        // Handle Upload Foto
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->fill($data)->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
