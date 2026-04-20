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
        
        $data = [
            'profile' => Profile::first(),
            'experiences' => Experience::orderBy('created_at', 'desc')->get(),
            'educations' => Experience::where('type', 'education')->orderBy('created_at', 'desc')->get(),
            'work_experiences' => Experience::where('type', 'work')->orderBy('created_at', 'desc')->get(),
            'organizations' => Experience::where('type', 'organization')->orderBy('created_at', 'desc')->get(), // INI BARIS BARU
            'skills' => Skill::all()->groupBy('category'),
            'projects' => Project::all(),
        ];

        if ($type == 'creative') {
            return view('admin.cv.preview_creative', $data);
        }

        return view('admin.cv.preview_ats', $data);
    }
}