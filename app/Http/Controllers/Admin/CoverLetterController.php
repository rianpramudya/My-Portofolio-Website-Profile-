<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class CoverLetterController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        
        // Teks default yang akan muncul di kotak input surat (Bisa diedit oleh user)
        $defaultContent = "Dengan hormat,\n\nSaya menulis surat ini untuk menyampaikan ketertarikan saya melamar posisi [POSISI] di [PERUSAHAAN].\n\nSaya adalah seorang " . ($profile->headline ?? 'profesional') . " dengan antusiasme tinggi terhadap pengembangan teknologi. Dalam profil profesional saya, saya memiliki rekam jejak dalam membangun berbagai aplikasi yang skalabel dan efisien. Saya yakin latar belakang dan keahlian teknis saya dapat memberikan kontribusi positif bagi tim Anda.\n\nTerlampir dalam lamaran ini adalah Curriculum Vitae (CV) saya yang merinci riwayat pekerjaan, pendidikan, dan portofolio proyek saya. Saya sangat berharap dapat diberikan kesempatan wawancara untuk mendiskusikan bagaimana saya dapat berkontribusi bagi perusahaan Anda.\n\nTerima kasih atas waktu dan pertimbangan Anda.";

        return view('admin.cover_letter.index', compact('defaultContent'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'recipient_name'  => 'required|string',
            'company_name'    => 'required|string',
            'company_address' => 'required|string',
            'position'        => 'required|string',
            'letter_content'  => 'required|string', // Validasi untuk kotak isi surat
        ]);

        $profile = Profile::first();
        if (!$profile) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Isi profil di dashboard terlebih dahulu sebelum membuat surat lamaran.');
        }
        $today = now()->locale('id')->translatedFormat('d F Y');

        // Ambil isi surat dari form
        $content = $request->letter_content;

        // Otomatis ubah tulisan [POSISI] dan [PERUSAHAAN] dari isi teks dengan inputan form
        $content = str_replace('[POSISI]', $request->position, $content);
        $content = str_replace('[PERUSAHAAN]', $request->company_name, $content);

        return view('admin.cover_letter.preview', [
            'profile' => $profile,
            'date'    => $today,
            'content' => $content,
            'input'   => $request->all()
        ]);
    }
}
