<?php

namespace App\Services;

use App\Exceptions\CvTranslationException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Throwable;

class CvTranslator
{
    public function translate(array $data, string $language): array
    {
        if ($language === 'original') {
            return $data;
        }

        // Only translate prose. Names, employers, certificates, technology names,
        // credentials, dates and contact details remain exactly as entered.
        $data['profile'] = clone $data['profile'];
        $slots = [];
        $add = function ($model, string $field) use (&$slots) {
            $value = $model->$field;
            foreach (is_array($value) ? $value : [$value] as $index => $text) {
                if (is_string($text) && trim($text) !== '') {
                    $slots[] = [$model, $field, is_array($value) ? $index : null, $text];
                }
            }
        };
        foreach (['headline', 'about_text'] as $field) {
            $add($data['profile'], $field);
        }
        foreach (['experiences', 'educations', 'work_experiences', 'organizations', 'projects'] as $group) {
            $data[$group] = $data[$group]->map(fn ($model) => clone $model);
            foreach ($data[$group] as $model) {
                $fields = $group === 'projects' ? ['category', 'description', 'cv_descriptions'] : ['role', 'description', 'cv_descriptions'];
                foreach ($fields as $field) {
                    $add($model, $field);
                }
            }
        }
        // Keep category keys unchanged so ATS technical/soft skill grouping works.
        $data['skills'] = $data['skills']->map(function ($items, $category) use ($add) {
            $items = $items->map(fn ($model) => clone $model);
            if (stripos($category, 'soft') !== false || stripos($category, 'non-teknis') !== false) {
                foreach ($items as $model) {
                    $add($model, 'name');
                }
            }
            return $items;
        });
        $data['skillCategoryLabels'] = $data['skills']->keys()->mapWithKeys(function ($category) use ($add) {
            $label = (object) ['name' => $category];
            $add($label, 'name');
            return [$category => $label];
        });

        $texts = array_values(array_unique(array_column($slots, 3)));
        if (!$texts) {
            return $data;
        }
        $url = config('cv.translation_url');
        if (!$url) {
            throw new CvTranslationException('Layanan terjemahan belum dikonfigurasi. Isi CV_TRANSLATION_URL di .env terlebih dahulu, atau pilih bahasa asli.');
        }
        $key = 'cv_translation:v1:'.hash('sha256', json_encode([$url, $language, $texts]));
        try {
            $translated = Cache::remember($key, now()->addDays(30), function () use ($texts, $url, $language) {
                $payload = ['q' => $texts, 'source' => 'auto', 'target' => $language, 'format' => 'text'];
                if ($apiKey = config('cv.translation_api_key')) {
                    $payload['api_key'] = $apiKey;
                }
                $response = Http::connectTimeout(5)->timeout(config('cv.translation_timeout'))
                    ->post(rtrim($url, '/').'/translate', $payload)->throw();
                $result = $response->json('translatedText');
                if (!is_array($result) || count($result) !== count($texts)
                    || array_filter($result, fn ($text) => !is_string($text) || trim($text) === '')) {
                    throw new RuntimeException('Invalid translation response');
                }
                return array_values($result);
            });
        } catch (Throwable $exception) {
            // Never return an untranslated PDF labelled as the selected language.
            throw new CvTranslationException('Terjemahan CV gagal. Periksa koneksi dan konfigurasi LibreTranslate, lalu coba lagi atau pilih bahasa asli.', 0, $exception);
        }
        $map = array_combine($texts, $translated);
        foreach ($slots as [$model, $field, $index, $text]) {
            if ($index === null) {
                $model->$field = $map[$text];
            } else {
                $points = $model->$field;
                $points[$index] = $map[$text];
                $model->$field = $points;
            }
        }
        return $data;
    }
}
