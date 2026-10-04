<?php

namespace Tests\Feature;

use App\Models\Certification;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicPortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_public_page_has_honest_states_and_no_invented_identity(): void
    {
        $this->get('/')->assertOk()
            ->assertSee('Profil belum tersedia.')
            ->assertSee('Belum ada sertifikasi yang ditambahkan.')
            ->assertSee('Belum ada proyek yang ditambahkan.')
            ->assertDontSee('Rian Pramudya Amanda')
            ->assertDontSee('Full Stack Web Developer');
    }

    public function test_every_public_cms_type_is_rendered_and_internal_records_are_excluded(): void
    {
        Profile::create(['name' => 'Nama dari CMS', 'headline' => 'Posisi dari CMS', 'about_text' => 'Profil dari CMS', 'email' => 'public@example.com', 'phone' => '0812345678', 'cv_link' => 'https://example.com/resume', 'github_link' => 'https://github.com/example', 'linkedin_link' => 'https://linkedin.com/in/example']);
        foreach (['work', 'education', 'organization'] as $type) {
            Experience::create(['type' => $type, 'role' => 'Role '.$type, 'company' => 'Company '.$type, 'period' => 'Periode '.$type, 'description' => 'Description '.$type, 'cv_descriptions' => ['Point '.$type]]);
        }
        Service::create(['title' => 'Layanan CMS', 'description' => 'Deskripsi layanan', 'icon' => 'ph-code']);
        Skill::create(['name' => 'Skill CMS', 'category' => 'Kategori CMS', 'proficiency' => 85]);
        Certification::create(['title' => 'Sertifikat CMS', 'issuer' => 'Penerbit CMS', 'date' => '2025-01-15', 'credential' => 'CREDENTIAL-123', 'description' => 'Deskripsi sertifikasi', 'url' => 'https://example.com/verify', 'image' => 'certifications/document.pdf']);
        Contact::create(['name' => 'Internal sender', 'email' => 'private@example.com', 'message' => 'INTERNAL_MESSAGE_DO_NOT_PUBLISH']);
        User::factory()->create(['email' => 'admin-private@example.com']);
        $response = $this->get('/')->assertOk();
        foreach (['Nama dari CMS', 'Posisi dari CMS', 'Profil dari CMS', 'public@example.com', '0812345678', 'https://example.com/resume', 'https://github.com/example', 'https://linkedin.com/in/example', 'Layanan CMS', 'Deskripsi layanan', 'Skill CMS', 'Kategori CMS', '85', 'Sertifikat CMS', 'Penerbit CMS', 'CREDENTIAL-123', 'Deskripsi sertifikasi', 'https://example.com/verify', 'storage/certifications/document.pdf'] as $text) {
            $response->assertSee($text);
        }
        foreach (['work', 'education', 'organization'] as $type) {
            foreach (['Role ', 'Company ', 'Periode ', 'Description ', 'Point '] as $field) {
                $response->assertSee($field.$type);
            }
        }
        $response->assertDontSee('private@example.com')->assertDontSee('INTERNAL_MESSAGE_DO_NOT_PUBLISH')->assertDontSee('admin-private@example.com');
    }

    public function test_all_projects_are_public_including_beyond_the_old_limit(): void
    {
        foreach (range(1, 8) as $number) {
            Project::create(['title' => 'CMS Project '.$number, 'category' => 'Web', 'description' => 'Description '.$number, 'link_url' => 'https://example.com/project-'.$number]);
        }
        $response = $this->get('/')->assertOk();
        foreach (range(1, 8) as $number) {
            $response->assertSee('CMS Project '.$number)->assertSee('https://example.com/project-'.$number);
        }
    }

    public function test_certificate_admin_create_update_and_delete_are_reflected_immediately(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $data = ['title' => 'New Certification', 'issuer' => 'Issuer', 'date' => '2025-03-01', 'credential' => 'CERT-001', 'description' => 'Original certification details', 'url' => 'https://example.com/verify'];
        $this->post(route('admin.certifications.store'), $data + ['image' => UploadedFile::fake()->create('certificate.pdf', 10, 'application/pdf')])->assertRedirect()->assertSessionHasNoErrors();
        $certificate = Certification::firstOrFail();
        $this->get('/')->assertSee('New Certification')->assertSee('Original certification details')->assertSee('CERT-001')->assertSee(asset('storage/'.$certificate->image))->assertSee('Buka PDF');
        $data['title'] = 'Updated Certification';
        $data['description'] = 'Updated certificate details';
        $this->put(route('admin.certifications.update', $certificate), $data)->assertRedirect()->assertSessionHasNoErrors();
        $this->get('/')->assertSee('Updated Certification')->assertSee('Updated certificate details')->assertDontSee('New Certification');
        $this->delete(route('admin.certifications.destroy', $certificate))->assertRedirect();
        $this->get('/')->assertDontSee('Updated Certification')->assertSee('Belum ada sertifikasi yang ditambahkan.');
    }

    public function test_certificate_image_document_and_plain_text_escaping_are_preserved(): void
    {
        Certification::create(['title' => 'Image Certification', 'issuer' => 'Issuer', 'date' => '2025-01-01', 'image' => 'certifications/image.png', 'description' => '<script>alert("unsafe")</script>']);
        $this->get('/')->assertOk()->assertSee('storage/certifications/image.png')
            ->assertSee('Dokumen Image Certification')
            ->assertSee('<script>alert("unsafe")</script>')
            ->assertDontSee('<script>alert("unsafe")</script>', false);
    }

    public function test_public_assets_are_isolated_from_admin_and_auth(): void
    {
        $publicCss = \Illuminate\Support\Facades\Vite::asset('resources/css/public.css');
        $publicJs = \Illuminate\Support\Facades\Vite::asset('resources/js/public.js');
        $this->get('/')->assertSee('public-site', false)->assertSee($publicCss, false)->assertSee($publicJs, false);
        $this->get('/login')->assertOk()->assertDontSee($publicCss, false)->assertDontSee($publicJs, false);
        $this->actingAs(User::factory()->create())->get('/admin/dashboard')->assertOk()->assertDontSee($publicCss, false)->assertDontSee($publicJs, false);
    }

    public function test_contact_validation_and_input_repopulation_still_work(): void
    {
        $this->from('/')->post('/contact', ['name' => 'Visitor', 'email' => 'invalid', 'message' => 'Message'])
            ->assertRedirect('/')->assertSessionHasErrors('email');
        $this->get('/')->assertOk()->assertSee('aria-invalid="true"', false)->assertSee('value="Visitor"', false);
    }
}
