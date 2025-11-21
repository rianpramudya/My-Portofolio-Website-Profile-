<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class CoverLetterController extends Controller
{
    public function index()
    {
        return view('admin.cover_letter.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required',
            'company_name' => 'required',
            'company_address' => 'required', // Tambahan validasi
            'position' => 'required',
        ]);

        $profile = Profile::first();
        $today = date('d F Y');

        // Template Surat Otomatis
        // Saya hapus bagian "Yth..." di awal $content karena sudah ada di Header surat (Preview)
        $content = "
Dengan hormat,

Saya menulis surat ini untuk menyampaikan ketertarikan saya melamar posisi {$request->position} di {$request->company_name}.

Saya adalah seorang {$profile->headline} dengan antusiasme tinggi terhadap pengembangan teknologi. Dalam profil profesional saya, saya memiliki rekam jejak dalam membangun berbagai aplikasi web yang skalabel dan efisien. Saya yakin latar belakang dan keahlian teknis saya dapat memberikan kontribusi positif bagi tim {$request->company_name}.

Terlampir dalam lamaran ini adalah Curriculum Vitae (CV) saya yang merinci riwayat pekerjaan, pendidikan, dan portofolio proyek saya. Saya sangat berharap dapat diberikan kesempatan wawancara untuk mendiskusikan bagaimana saya dapat berkontribusi bagi perusahaan Anda.

Terima kasih atas waktu dan pertimbangan Anda.
        ";

        return view('admin.cover_letter.preview', [
            'profile' => $profile,
            'date' => $today,
            'content' => $content,
            'input' => $request->all()
        ]);
    }
}