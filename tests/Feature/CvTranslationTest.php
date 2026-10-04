<?php

namespace Tests\Feature;

use App\Models\Experience;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CvTranslationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['cv.translation_url' => 'https://translate.example', 'cv.translation_api_key' => 'test-key']);
        Http::preventStrayRequests();
        $this->actingAs(User::factory()->create());
        Profile::create([
            'name' => 'Jane Doe', 'headline' => 'Developer', 'about_text' => 'I build websites.',
            'email' => 'jane@example.com', 'linkedin_link' => '-', 'github_link' => '-',
        ]);
        Experience::create([
            'role' => 'Developer', 'company' => 'Acme', 'period' => '2020 - 2024',
            'description' => 'I build websites.', 'cv_descriptions' => ['Built websites.'], 'type' => 'work',
        ]);
    }

    private function fakeTranslations(): void
    {
        Http::fake(['translate.example/*' => function ($request) {
            $map = $request['target'] === 'id'
                ? ['Developer' => 'Pengembang', 'I build websites.' => 'Saya membuat situs web.', 'Built websites.' => 'Membuat situs web.']
                : ['Pengembang' => 'Developer', 'Saya membuat situs web.' => 'I build websites.', 'Membuat situs web.' => 'Built websites.'];
            return Http::response(['translatedText' => array_map(fn ($text) => $map[$text] ?? $text, $request['q'])]);
        }]);
    }

    public function test_both_formats_translate_content_without_changing_cms_and_share_cache(): void
    {
        $this->fakeTranslations();
        foreach (['ats', 'creative'] as $type) {
            $this->post(route('admin.cv.generate'), ['type' => $type, 'language' => 'id'])
                ->assertOk()->assertSee('lang="id"', false)->assertSee('Pengalaman Kerja')
                ->assertSee('Saya membuat situs web.')->assertSee('Membuat situs web.')
                ->assertSee('Jane Doe')->assertSee('Acme')->assertSee('jane@example.com')
                ->assertSee('value="id" selected', false);
        }
        Http::assertSentCount(1);
        Http::assertSent(fn ($request) => $request['source'] === 'auto' && $request['target'] === 'id' && $request['api_key'] === 'test-key');
        $this->assertDatabaseHas('profiles', ['headline' => 'Developer', 'about_text' => 'I build websites.']);
        $this->assertSame(['Built websites.'], Experience::first()->cv_descriptions);
        Profile::first()->update(['about_text' => 'Updated biography']);
        $this->post(route('admin.cv.generate'), ['language' => 'id'])->assertOk()->assertSee('Updated biography');
        Http::assertSentCount(2);
    }

    public function test_indonesian_input_can_be_translated_to_english(): void
    {
        Profile::first()->update(['headline' => 'Pengembang', 'about_text' => 'Saya membuat situs web.']);
        Experience::first()->update(['role' => 'Pengembang', 'description' => 'Saya membuat situs web.', 'cv_descriptions' => ['Membuat situs web.']]);
        $this->fakeTranslations();
        foreach (['ats', 'creative'] as $type) {
            $this->post(route('admin.cv.generate'), ['type' => $type, 'language' => 'en'])
                ->assertOk()->assertSee('lang="en"', false)->assertSee('Work Experience')
                ->assertSee('I build websites.')->assertSee('Built websites.');
        }
        Http::assertSentCount(1);
    }

    public function test_original_language_works_without_translation_service(): void
    {
        config(['cv.translation_url' => null]);
        $this->post(route('admin.cv.generate'), ['language' => 'original'])->assertOk()->assertSee('I build websites.');
        Http::assertNothingSent();
    }

    public function test_download_and_preview_report_translation_failure_instead_of_using_original_text(): void
    {
        Http::fake(['*' => Http::response(['error' => 'Unavailable'], 503)]);
        $this->post(route('admin.cv.generate'), ['language' => 'id'])
            ->assertRedirect(route('admin.cv.index'))->assertSessionHas('error');
        $this->get(route('admin.cv.download', ['language' => 'id']))
            ->assertRedirect(route('admin.cv.index'))->assertSessionHas('error');
        Http::assertSentCount(2);
    }

    public function test_missing_configuration_and_malformed_responses_are_reported(): void
    {
        config(['cv.translation_url' => null]);
        $this->get(route('admin.cv.download', ['language' => 'en']))->assertRedirect(route('admin.cv.index'))->assertSessionHas('error');
        Http::assertNothingSent();
        config(['cv.translation_url' => 'https://translate.example']);
        Http::fake(['*' => Http::response(['translatedText' => ['Wrong count']])]);
        $this->post(route('admin.cv.generate'), ['language' => 'id'])->assertRedirect(route('admin.cv.index'))->assertSessionHas('error');
    }

    public function test_unsupported_language_and_type_are_rejected(): void
    {
        $this->postJson(route('admin.cv.generate'), ['language' => 'fr', 'type' => 'invalid'])
            ->assertUnprocessable()->assertJsonValidationErrors(['language', 'type']);
        $this->getJson(route('admin.cv.download', ['language' => 'fr']))
            ->assertUnprocessable()->assertJsonValidationErrors('language');
        Http::assertNothingSent();
    }
}
