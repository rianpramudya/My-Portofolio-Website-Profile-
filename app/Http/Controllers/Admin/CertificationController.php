<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::latest()->paginate(10);
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'issuer'      => 'required|string|max:255',
            'date'        => 'required|date',
            'credential'  => 'nullable|string|max:255',
            'url'         => 'nullable|url|max:500',
            'image'       => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120', // ← PDF + max 5MB
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('certifications', 'public');
        }

        Certification::create($validated);

        return redirect()->route('admin.certifications.index')
                         ->with('success', 'Sertifikasi berhasil ditambahkan.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'issuer'      => 'required|string|max:255',
            'date'        => 'required|date',
            'credential'  => 'nullable|string|max:255',
            'url'         => 'nullable|url|max:500',
            'image'       => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120', // ← PDF + max 5MB
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($certification->image) {
                Storage::disk('public')->delete($certification->image);
            }
            $validated['image'] = $request->file('image')->store('certifications', 'public');
        }

        $certification->update($validated);

        return redirect()->route('admin.certifications.index')
                         ->with('success', 'Sertifikasi berhasil diperbarui.');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->image) {
            Storage::disk('public')->delete($certification->image);
        }
        $certification->delete();

        return redirect()->route('admin.certifications.index')
                         ->with('success', 'Sertifikasi berhasil dihapus.');
    }
}