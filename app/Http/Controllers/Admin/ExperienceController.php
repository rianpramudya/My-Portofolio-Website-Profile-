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
    $request->validate([
        'role' => 'required|string|max:255',
        'company' => 'required|string|max:255',
        'period' => 'required|string|max:255',
        'type' => 'required|in:work,education,organization',
        'description' => 'required|string',
        'cv_descriptions' => 'nullable|array',
    ]);

    $data = $request->all();
    if (isset($data['cv_descriptions'])) {
        $data['cv_descriptions'] = array_values(array_filter($data['cv_descriptions']));
    }

    Experience::create($data);
    return redirect()->route('admin.experiences.index')->with('success', 'Data berhasil ditambahkan!');
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
        'type' => 'required|in:work,education,organization',
        'description' => 'required|string',
        'cv_descriptions' => 'nullable|array',
    ]);

    $data = $request->all();
    if (isset($data['cv_descriptions'])) {
        $data['cv_descriptions'] = array_values(array_filter($data['cv_descriptions']));
    } else {
        $data['cv_descriptions'] = null;
    }

    $experience->update($data);
    return redirect()->route('admin.experiences.index')->with('success', 'Data diperbarui!');
}

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Data pengalaman berhasil dihapus!');
    }
}