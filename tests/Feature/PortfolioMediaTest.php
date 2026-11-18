<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioMediaTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_portfolio_and_hamburg_pages_render_in_all_languages(): void
    {
        foreach (['ru', 'tm', 'en'] as $locale) {
            $this->get("/{$locale}/projects")
                ->assertOk()
                ->assertSee('hamburg-port-cover.webp')
                ->assertSee('hamburg-port-story.webp')
                ->assertSee('logitrans-event.mp4');
            $this->get("/{$locale}/projects/hamburg")
                ->assertOk()
                ->assertSee('hamburg-port-mobile.mp4')
                ->assertSee('hamburg-port-visit-poster.webp');
        }
    }

    public function test_every_referenced_media_asset_exists_in_public_directory(): void
    {
        $assets = [
            'hamburg-port-cover.webp',
            'hamburg-port-story.webp',
            'hamburg-port-mobile.mp4',
            'hamburg-port-visit-poster.webp',
        ];

        foreach (config('zny_media.portfolio', []) as $item) {
            $assets[] = $item['image'];
        }
        foreach (config('zny_media.events', []) as $item) {
            $assets[] = $item['poster'];
            $assets[] = $item['video'];
        }

        foreach (array_unique($assets) as $file) {
            $path = public_path('media/zny/' . $file);
            $this->assertFileExists($path, "Missing media file: {$file}");
            $this->assertGreaterThan(0, filesize($path), "Empty media file: {$file}");
        }
    }

    public function test_portfolio_seo_is_localized(): void
    {
        foreach (['ru', 'tm', 'en'] as $locale) {
            $this->get("/{$locale}/projects")
                ->assertOk()
                ->assertSee("https://znylogistic.com/{$locale}/projects");
            $this->get("/{$locale}/projects/hamburg")
                ->assertOk()
                ->assertSee("https://znylogistic.com/{$locale}/projects/hamburg");
        }
    }
}
