<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'subject',
        'type',
        'status',
        'details',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
