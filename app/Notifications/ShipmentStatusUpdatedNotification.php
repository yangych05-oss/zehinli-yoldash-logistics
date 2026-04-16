<?php

namespace App\Notifications;

use App\Models\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShipmentStatusUpdatedNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Shipment $shipment)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Shipment status updated')
            ->greeting('Shipment update')
            ->line("Tracking code: {$this->shipment->tracking_code}")
            ->line("Current status: {$this->shipment->status}")
            ->line("Current location: {$this->shipment->current_location}");
    }
}
