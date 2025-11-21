<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        // Mengambil data experience diurutkan dari yang terbaru
        $experiences = Experience::latest()->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        // Validasi sesuai kolom tabel experiences
        $request->validate([
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'type' => 'required|in:work,education', // Hanya boleh 'work' atau 'education'
            'description' => 'required|string',
        ]);

        Experience::create($request->all());

        return redirect()->route('admin.experiences.index')->with('success', 'Data pengalaman berhasil ditambahkan!');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'type' => 'required|in:work,education',
            'description' => 'required|string',
        ]);

        $experience->update($request->all());

        return redirect()->route('admin.experiences.index')->with('success', 'Data pengalaman berhasil diperbarui!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Data pengalaman berhasil dihapus!');
    }
}