<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Lead $lead)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New lead received')
            ->greeting('New lead captured')
            ->line("Name: {$this->lead->name}")
            ->line("Email: {$this->lead->email}")
            ->line("Route: {$this->lead->origin} → {$this->lead->destination}")
            ->line('Please review this lead in the admin panel.');
    }
}
