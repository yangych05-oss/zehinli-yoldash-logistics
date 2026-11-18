<?php

namespace App\Models;

use App\Notifications\ShipmentStatusUpdatedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'tracking_code',
        'public_access_code',
        'client_id',
        'origin',
        'destination',
        'status',
        'eta',
        'current_location',
        'details',
    ];

    protected function casts(): array
    {
        return [
            'eta' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::updated(function (Shipment $shipment): void {
            if (! $shipment->wasChanged('status')) {
                return;
            }

            if ($shipment->client?->email) {
                // The status is already stored when this event fires. An email
                // transport failure must not masquerade as an update failure.
                try {
                    $shipment->client->notify(new ShipmentStatusUpdatedNotification($shipment));
                } catch (\Throwable $exception) {
                    Log::error('Shipment status notification failed after persistence.', [
                        'shipment_id' => $shipment->getKey(),
                        'exception_type' => $exception::class,
                    ]);
                }
            }
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function events()
    {
        return $this->hasMany(ShipmentEvent::class);
    }
}
