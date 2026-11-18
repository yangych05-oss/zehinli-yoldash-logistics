<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use RuntimeException;
use Tests\TestCase;

class SubmissionResilienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_remains_saved_when_smtp_fails(): void
    {
        Mail::shouldReceive('raw')
            ->once()
            ->andThrow(new RuntimeException('simulated smtp outage'));

        $this->from('/ru/contact')->post('/ru/contact', [
            'name' => 'CI Test Sender',
            'email' => 'sender@example.test',
            'phone' => '+99300000000',
            'message' => 'CI delivery-test only, never sent to production.',
        ])->assertRedirect('/ru/contact');

        $this->assertSame(1, ContactMessage::query()->count());
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'sender@example.test',
            'locale' => 'ru',
        ]);
    }

    public function test_quote_remains_saved_when_notification_fails(): void
    {
        $notificationAttempts = 0;
        Notification::shouldReceive('route')
            ->zeroOrMoreTimes()
            ->andReturnUsing(function () use (&$notificationAttempts) {
                $notificationAttempts++;
                throw new RuntimeException('simulated smtp outage');
            });

        $this->from('/en/services')->post('/en/quote-request', [
            'name' => 'CI Quote Contact',
            'company' => 'CI Test Company',
            'email' => 'quote@example.test',
            'phone' => '+99300000001',
            'origin' => 'Test Origin',
            'destination' => 'Test Destination',
            'cargo_details' => 'One test pallet (virtual record).',
        ])->assertRedirect('/en/services')->assertSessionHasNoErrors();

        $this->assertSame(1, $notificationAttempts, 'Notification must be attempted once after persisting lead.');
        $this->assertSame(1, Lead::query()->count());
        $this->assertDatabaseHas('leads', [
            'email' => 'quote@example.test',
            'locale' => 'en',
            'status' => 'new',
        ]);
    }
}
