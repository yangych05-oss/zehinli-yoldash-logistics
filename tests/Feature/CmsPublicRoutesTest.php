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
}
