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
            ->subject('New lead received - ZNY LOGISTICS')
            ->greeting('New lead captured for ZNY LOGISTICS')
            ->line("Name: {$this->lead->name}")
            ->line("Email: {$this->lead->email}")
            ->line("Route: {$this->lead->origin} → {$this->lead->destination}")
            ->line('Please review this lead in the ZNY LOGISTICS admin panel.')
            ->salutation('ZNY LOGISTICS | info@znylogistics.com | akja@znylogistics.com');
    }
}
