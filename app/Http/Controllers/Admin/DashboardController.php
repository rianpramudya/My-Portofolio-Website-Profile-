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
                'email' => 'email@anda.com'
            ]
        );

        return view('admin.dashboard', compact('profile', 'projectCount', 'experienceCount'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $profile = Profile::first();
        $data = $request->all();

        // Handle Upload Foto
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}