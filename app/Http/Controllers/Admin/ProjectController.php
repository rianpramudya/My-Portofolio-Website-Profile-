<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'link_url' => 'nullable|url',
            'cv_descriptions' => 'nullable|array', // Validasi array
            'cv_descriptions.*' => 'nullable|string' // Tiap item array harus string
        ]);

        $data = $request->all();

        // Bersihkan array dari input yang kosong/null
        if (isset($data['cv_descriptions'])) {
            $data['cv_descriptions'] = array_filter($data['cv_descriptions'], function($value) {
                return !is_null($value) && $value !== '';
            });
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
            'link_url' => 'nullable|url',
            'cv_descriptions' => 'nullable|array',
            'cv_descriptions.*' => 'nullable|string'
        ]);

        $data = $request->all();

        // Bersihkan array dari input yang kosong
        if (isset($data['cv_descriptions'])) {
            $data['cv_descriptions'] = array_filter($data['cv_descriptions'], function($value) {
                return !is_null($value) && $value !== '';
            });
            // Re-index array (penting untuk JSON)
            $data['cv_descriptions'] = array_values($data['cv_descriptions']);
        } else {
            // Jika kosong, set ke null
            $data['cv_descriptions'] = null;
        }

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project dihapus!');
    }
}