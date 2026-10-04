<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\CvController;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use Mockery;
use Tests\TestCase;

class CvPdfTest extends TestCase
{
    use RefreshDatabase;

    #[RunInSeparateProcess]
    #[PreserveGlobalState(false)]
    public function test_both_pdf_formats_download_in_each_selected_language(): void
    {
        config(['cv.translation_url' => 'https://translate.example']);
        Profile::create(['name' => 'Test User', 'headline' => 'Developer', 'about_text' => 'About', 'linkedin_link' => '-', 'github_link' => '-']);
        Http::fake(['*' => function ($request) {
            return Http::response(['translatedText' => array_map(
                fn ($text) => $request['target'] === 'id' ? 'Teks Indonesia' : 'English text', $request['q']
            )]);
        }]);
        $browser = Mockery::mock('alias:Spatie\\Browsershot\\Browsershot');
        foreach (['format', 'showBackground', 'noSandbox', 'timeout', 'setDelay'] as $method) {
            $browser->shouldReceive($method)->times(4)->andReturnSelf();
        }
        $browser->shouldReceive('margins')->with(15, 15, 15, 15)->twice()->andReturnSelf();
        $browser->shouldReceive('margins')->with(0, 0, 0, 0)->twice()->andReturnSelf();
        $browser->shouldReceive('html')->times(4)->withArgs(function ($html) {
            $indonesian = str_contains($html, 'lang="id"');
            $this->assertStringContainsString($indonesian ? 'Teks Indonesia' : 'English text', $html);
            $this->assertStringContainsString($indonesian ? 'Pengalaman Kerja' : 'Work Experience', $html);
            return true;
        })->andReturnSelf();
        $browser->shouldReceive('pdf')->times(4)->andReturn('%PDF-test');
        foreach (['ats' => 'ATS', 'creative' => 'Creative'] as $type => $name) {
            foreach (['id', 'en'] as $language) {
                $response = (new CvController)->downloadPdf(Request::create('/', 'GET', compact('type', 'language')));
                $this->assertSame('%PDF-test', $response->getContent());
                $this->assertSame('attachment; filename="CV_'.$name.'_test_user_'.strtoupper($language).'.pdf"', $response->headers->get('Content-Disposition'));
            }
        }
        Http::assertSentCount(2);
    }

    public function test_creative_pdf_embeds_avatar_and_uses_full_page_margins(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('avatar.png', base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII='
        ));
        Profile::create([
            'name' => 'Test User', 'headline' => 'Developer', 'about_text' => 'About',
            'avatar' => 'avatar.png', 'linkedin_link' => '-', 'github_link' => '-',
        ]);

        $browser = Mockery::mock('alias:Spatie\\Browsershot\\Browsershot');
        $browser->shouldReceive('html')->once()->withArgs(function (string $html) {
            $this->assertStringContainsString('src="data:image/png;base64,', $html);
            $this->assertStringNotContainsString('/storage/avatar.png', $html);
            return true;
        })->andReturnSelf();
        $browser->shouldReceive('format')->with('A4')->andReturnSelf();
        $browser->shouldReceive('margins')->with(0, 0, 0, 0)->andReturnSelf();
        $browser->shouldReceive('showBackground')->andReturnSelf();
        $browser->shouldReceive('noSandbox')->andReturnSelf();
        $browser->shouldReceive('timeout')->with(90)->andReturnSelf();
        $browser->shouldReceive('setDelay')->with(800)->andReturnSelf();
        $browser->shouldReceive('pdf')->once()->andReturn('%PDF-test');

        $response = (new CvController)->downloadPdf(Request::create('/', 'GET', ['type' => 'creative']));
        $this->assertSame('application/pdf', $response->headers->get('Content-Type'));
        $this->assertSame('attachment; filename="CV_Creative_test_user.pdf"', $response->headers->get('Content-Disposition'));
    }
}
