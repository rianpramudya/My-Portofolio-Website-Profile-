<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Service;
use App\Models\Certification;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsQaTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_and_admin_pages_render_on_an_empty_database(): void
    {
        $this->get('/')->assertOk();
        $this->get('/admin/dashboard')->assertRedirect('/login');
        $this->actingAs(User::factory()->create());
        foreach (['projects', 'experiences', 'services', 'certifications', 'skills', 'contacts', 'cv', 'letter'] as $path) {
            $this->get('/admin/'.$path)->assertOk();
        }
        foreach (['projects', 'experiences', 'services', 'certifications'] as $path) {
            $this->get('/admin/'.$path.'/create')->assertOk();
        }
        $this->get('/admin/dashboard')->assertOk();
    }

    public function test_cms_create_edit_update_delete_and_public_rendering(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get('/admin/dashboard')->assertOk();
        $cases = [
            'projects' => [Project::class, ['title' => 'Project QA', 'category' => 'Backend', 'description' => 'Description', 'link_url' => 'https://example.com/project', 'cv_descriptions' => ['', 'CV bullet']]],
            'experiences' => [Experience::class, ['role' => 'Developer', 'company' => 'Acme', 'period' => '2020', 'description' => 'Description', 'type' => 'work', 'cv_descriptions' => ['CV bullet']]],
            'services' => [Service::class, ['title' => 'Service QA', 'description' => 'Description', 'icon' => 'ph-code']],
            'certifications' => [Certification::class, ['title' => 'Certification QA', 'issuer' => 'Issuer', 'date' => '2025-01-01']],
            'skills' => [Skill::class, ['name' => 'PHP', 'category' => 'Backend', 'proficiency' => 80, 'icon' => 'ph-code']],
        ];
        foreach ($cases as $resource => [$class, $data]) {
            $this->post('/admin/'.$resource, $data)->assertRedirect()->assertSessionHasNoErrors();
            $model = $class::firstOrFail();
            $this->get('/admin/'.$resource)->assertOk();
            $this->get('/admin/'.$resource.'/'.$model->id.'/edit')->assertOk();
            $this->put('/admin/'.$resource.'/'.$model->id, $data)->assertRedirect()->assertSessionHasNoErrors();
        }
        $this->get('/')->assertOk()->assertSee('Project QA');
        foreach (['ats', 'creative'] as $type) {
            $this->post('/admin/cv/generate', ['type' => $type])->assertOk()->assertSee('CV bullet');
        }
        foreach ($cases as $resource => [$class]) {
            $model = $class::firstOrFail();
            $this->delete('/admin/'.$resource.'/'.$model->id)->assertRedirect();
            $this->assertDatabaseMissing($model->getTable(), ['id' => $model->id]);
        }
    }

    public function test_cover_letter_without_profile_does_not_crash(): void
    {
        $this->actingAs(User::factory()->create());
        $this->post('/admin/letter/generate', [
            'recipient_name' => 'HR', 'company_name' => 'Acme', 'company_address' => 'Jakarta',
            'position' => 'Developer', 'letter_content' => 'Lamaran [POSISI] di [PERUSAHAAN]',
        ])->assertRedirect(route('admin.dashboard'))->assertSessionHas('error');
    }

    public function test_public_contact_cannot_set_read_status(): void
    {
        $this->post('/contact', ['name' => 'Visitor', 'email' => 'visitor@example.com', 'message' => 'Hello', 'is_read' => true])->assertRedirect();
        $this->assertDatabaseHas('contacts', ['email' => 'visitor@example.com', 'is_read' => false]);
    }

    public function test_ats_displays_project_link_saved_by_cms(): void
    {
        $this->actingAs(User::factory()->create());
        Project::create(['title' => 'QA', 'category' => 'Backend', 'description' => 'Description', 'link_url' => 'https://example.com/project']);
        $this->post('/admin/cv/generate', ['type' => 'ats'])->assertOk()->assertSee('example.com/project');
    }

    public function test_profile_can_be_saved_before_first_dashboard_visit(): void
    {
        $this->actingAs(User::factory()->create());
        $this->put('/admin/profile', ['name' => 'QA User'])->assertRedirect()->assertSessionHasNoErrors();
        $this->assertDatabaseHas('profiles', ['name' => 'QA User']);
        $this->putJson('/admin/profile', ['name' => 'QA', 'email' => 'invalid'])->assertUnprocessable();
    }

    public function test_inbox_read_and_delete_actions(): void
    {
        $this->post('/contact', ['name' => 'Visitor', 'email' => 'visitor@example.com', 'message' => 'QA inbox'])->assertRedirect();
        $message = \App\Models\Contact::firstOrFail();
        $this->actingAs(User::factory()->create());
        $this->patch('/admin/contacts/'.$message->id.'/read')->assertRedirect();
        $this->assertDatabaseHas('contacts', ['id' => $message->id, 'is_read' => true]);
        $this->delete('/admin/contacts/'.$message->id)->assertRedirect();
        $this->assertDatabaseMissing('contacts', ['id' => $message->id]);
    }
}
