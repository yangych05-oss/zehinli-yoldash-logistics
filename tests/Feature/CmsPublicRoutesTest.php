<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Public Blade / controller compatibility in disposable Laravel+DB.
 * No contact forms are submitted and no production services are called.
 */
final class CmsPublicRoutesTest extends TestCase
{
    public function test_fifteen_localized_public_pages_return_success(): void
    {
        $sections = ['', '/about', '/services', '/contact', '/tracking'];

        foreach (['ru', 'tm', 'en'] as $locale) {
            foreach ($sections as $section) {
                $path = '/'.$locale.$section;
                $response = $this->get($path);

                $response->assertOk();
                $response->assertHeader('X-Content-Type-Options', 'nosniff');
                $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
                $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
                $this->assertStringContainsString(
                    '<html',
                    strtolower((string) $response->getContent()),
                    'Page '.$path.' must render HTML',
                );
                $this->assertStringNotContainsString(
                    'Hero title RU: ТЕСТ ZNY LOGISTICS',
                    (string) $response->getContent(),
                    'Old test hero must not reappear on '.$path,
                );
            }
        }
    }

    public function test_gallery_is_part_of_home_page_without_eager_video_downloads(): void
    {
        $response = $this->get('/ru');
        $response->assertOk();
        $html = (string) $response->getContent();

        $this->assertStringContainsString('zny-media', $html);
        $this->assertStringContainsString('gallery.css', $html);
        $this->assertStringContainsString('preload="none"', $html);
    }
    public function test_published_page_photo_override_and_fallback(): void
    {
        $media = \App\Models\SiteMediaItem::create([
            'collection' => 'page-about',
            'kind' => 'image',
            'slot' => 0,
            'file_path' => 'cms/media/cms-about-hero-qa.webp',
            'caption_en' => 'Company operations',
            'is_published' => true,
        ]);

        $this->get('/ru/about')
            ->assertOk()
            ->assertSee('storage/cms/media/cms-about-hero-qa.webp', false);

        $this->get('/en/about')
            ->assertOk()
            ->assertSee('storage/cms/media/cms-about-hero-qa.webp', false);

        $media->update(['is_published' => false]);

        $this->get('/ru/about')
            ->assertOk()
            ->assertDontSee('storage/cms/media/cms-about-hero-qa.webp', false);
    }

    public function test_hsts_is_opt_in_after_verified_https_cutover(): void
    {
        config(['zny_security.hsts_enabled' => false]);
        $this->withServerVariables(['HTTPS' => 'on'])
            ->get('/ru')
            ->assertOk()
            ->assertHeaderMissing('Strict-Transport-Security');

        config(['zny_security.hsts_enabled' => true]);
        $this->withServerVariables(['HTTPS' => 'on'])
            ->get('/ru')
            ->assertOk()
            ->assertHeader('Strict-Transport-Security', 'max-age=86400');
        config(['zny_security.hsts_enabled' => false]);
    }

}
