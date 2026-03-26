<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Company;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Testimonial;
use Database\Seeders\WebsiteStaticSeeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebsiteDataSyncService
{
    public function importAndLocalize(): array
    {
        app(WebsiteStaticSeeder::class)->run();

        $stats = [
            'company' => 0,
            'clients' => 0,
            'projects' => 0,
            'project_images' => 0,
            'products' => 0,
            'testimonials' => 0,
        ];

        if ($company = Company::query()->first()) {
            if ($this->localizeImage($company, 'logo_url', 'logo_path', 'company')) {
                $stats['company']++;
            }
        }

        foreach (Client::query()->get() as $client) {
            if ($this->localizeImage($client, 'logo_url', 'logo_path', 'clients')) {
                $stats['clients']++;
            }
        }

        foreach (Project::query()->get() as $project) {
            if ($this->localizeImage($project, 'main_image_url', 'main_image_path', 'projects/main')) {
                $stats['projects']++;
            }
        }

        foreach (ProjectImage::query()->get() as $image) {
            if ($this->localizeImage($image, 'image_url', 'image_path', 'projects/gallery')) {
                $stats['project_images']++;
            }
        }

        foreach (Product::query()->get() as $product) {
            if ($this->localizeImage($product, 'image_url', 'image_path', 'products')) {
                $stats['products']++;
            }
        }

        foreach (Testimonial::query()->get() as $testimonial) {
            if ($this->localizeImage($testimonial, 'avatar_url', 'avatar_path', 'testimonials')) {
                $stats['testimonials']++;
            }
        }

        return $stats;
    }

    private function localizeImage(object $model, string $urlField, string $pathField, string $dir): bool
    {
        $url = (string) ($model->{$urlField} ?? '');
        $path = (string) ($model->{$pathField} ?? '');

        if ($path !== '' && Storage::disk('public')->exists($path)) {
            return false;
        }

        if ($url === '' || !$this->isRemoteHttpUrl($url)) {
            return false;
        }

        try {
            $response = Http::timeout(30)->retry(1, 200)->get($url);
            if (!$response->successful()) {
                return false;
            }

            $extension = $this->resolveExtension($url, (string) $response->header('Content-Type', ''));
            $relativePath = trim($dir, '/').'/'.Str::uuid().'.'.$extension;

            Storage::disk('public')->put($relativePath, $response->body());

            $model->{$pathField} = $relativePath;
            $model->{$urlField} = Storage::disk('public')->url($relativePath);
            $model->save();

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function isRemoteHttpUrl(string $url): bool
    {
        if (!preg_match('/^https?:\/\//i', $url)) {
            return false;
        }

        return !str_contains($url, '/storage/');
    }

    private function resolveExtension(string $url, string $contentType): string
    {
        $type = strtolower(trim(explode(';', $contentType)[0]));
        $map = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/gif' => 'gif',
            'image/svg+xml' => 'svg',
        ];

        if (isset($map[$type])) {
            return $map[$type];
        }

        $path = parse_url($url, PHP_URL_PATH) ?: '';
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return $ext !== '' ? $ext : 'jpg';
    }
}
