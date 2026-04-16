<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
