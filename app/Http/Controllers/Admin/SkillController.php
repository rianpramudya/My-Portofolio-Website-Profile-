<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return view('admin.skills.index', compact('skills'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'proficiency' => 'required|integer|min:0|max:100',
            'icon' => 'required'
        ]);
        
        Skill::create($request->all());
        return back()->with('success', 'Skill added!');
    }

    // --- TAMBAHAN BARU UNTUK FITUR EDIT ---
    
    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'proficiency' => 'required|integer|min:0|max:100',
            'icon' => 'required'
        ]);

        $skill->update($request->all());
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully!');
    }

    // --------------------------------------

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill deleted!');
    }
}