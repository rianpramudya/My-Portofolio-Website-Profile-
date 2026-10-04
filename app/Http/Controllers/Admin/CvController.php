<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Certification;
use App\Services\CvTranslator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use App\Exceptions\CvTranslationException;
use Spatie\Browsershot\Browsershot;

class CvController extends Controller
{
    public function index()
    {
        return view('admin.cv.index');
    }

    public function generate(Request $request)
    {
        [$type, $language] = $this->options($request);
        try {
            $data = $this->localizedData($language);
        } catch (CvTranslationException $exception) {
            return redirect()->route('admin.cv.index')->with('error', $exception->getMessage());
        }

        if ($type == 'creative') {
            return view('admin.cv.preview_creative', $data);
        }

        return view('admin.cv.preview_ats', $data);
    }

    /**
     * Generate & download CV sebagai PDF asli lewat server-side rendering
     * (Chromium headless via Browsershot), bukan window.print() browser.
     * Sehingga tidak ada header/footer bawaan browser (URL, tanggal, dsb).
     */
    public function downloadPdf(Request $request)
    {
        [$type, $language] = $this->options($request);
        set_time_limit(120);
        try {
            $data = $this->localizedData($language);
        } catch (CvTranslationException $exception) {
            return redirect()->route('admin.cv.index')->with('error', $exception->getMessage());
        }

        // Gunakan template PDF khusus (tanpa tombol no-print & tanpa @media print)
        // Embed foto agar Chromium tidak meminta URL aplikasi yang sedang
        // menunggu proses PDF (deadlock pada server PHP dengan satu worker).
        $data['pdfAvatar'] = $this->pdfAvatar($data['profile']);
        $data['isPdf'] = true;
        $viewName = $type == 'creative'
            ? 'admin.cv.pdf_creative'
            : 'admin.cv.pdf_ats';

        $html = View::make($viewName, $data)->render();

        $profileName = $data['profile']->name ?? 'CV';
        $fileName = 'CV_' . ($type === 'creative' ? 'Creative' : 'ATS') . '_'
            . (Str::slug($profileName, '_') ?: 'profile')
            . ($language === 'original' ? '' : '_'.strtoupper($language)) . '.pdf';

        // Naikkan batas waktu eksekusi PHP khusus untuk request ini,
        // karena render PDF via Chromium bisa lebih lama dari 30 detik default.
        set_time_limit(120);

        $pdf = Browsershot::html($html)
            ->format('A4')
            ->margins(...array_fill(0, 4, $type === 'creative' ? 0 : 15))
            ->showBackground()
            ->noSandbox() // hindari hang karena sandbox Chromium di beberapa environment lokal
            ->timeout(90) // batas waktu proses Node/Chromium sendiri (detik)
            ->setDelay(800) // beri jeda singkat agar Tailwind CDN & Google Fonts sempat load,
                             // TANPA menunggu network benar-benar idle (yang bisa hang selamanya)
            ->pdf();

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    private function options(Request $request): array
    {
        $request->validate([
            'type' => 'sometimes|in:ats,creative',
            'language' => 'sometimes|in:original,id,en',
        ]);
        return [$request->input('type', 'ats'), $request->input('language', 'original')];
    }

    private function localizedData(string $language): array
    {
        $data = app(CvTranslator::class)->translate($this->getCvData(), $language);
        $data['cvLanguage'] = $language;
        $data['cvLocale'] = $language === 'original' ? 'en' : $language;
        $data['cvLabels'] = Lang::get('cv', [], $data['cvLocale']);
        return $data;
    }

    private function pdfAvatar(Profile $profile): ?string
    {
        if (!$profile->avatar) {
            return null;
        }

        $disk = Storage::disk('public');
        if (!$disk->exists($profile->avatar)) {
            return null;
        }

        $mime = $disk->mimeType($profile->avatar);
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], true)) {
            return null;
        }

        return 'data:' . $mime . ';base64,' . base64_encode($disk->get($profile->avatar));
    }

    /**
     * Ambil semua data CV. Dipakai bersama oleh generate() (preview di browser)
     * dan downloadPdf() (render PDF asli di server), supaya datanya selalu identik.
     */
    private function getCvData(): array
    {
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

        return [
            'profile' => $profile,
            'experiences' => Experience::orderBy('created_at', 'desc')->get(),
            'educations' => Experience::where('type', 'education')->orderBy('created_at', 'desc')->get(),
            'work_experiences' => Experience::where('type', 'work')->orderBy('created_at', 'desc')->get(),
            'organizations' => Experience::where('type', 'organization')->orderBy('created_at', 'desc')->get(),
            'skills' => Skill::all()->groupBy('category'),
            'projects' => Project::all(),
            'certifications' => Certification::orderBy('date', 'desc')->get(),
        ];
    }
}
