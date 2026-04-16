<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'shipment_id',
        'request_id',
        'title',
        'file_path',
        'mime_type',
    ];
}
