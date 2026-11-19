<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteCopyOverride extends Model
{
    protected $fillable = [
        'page', 'locale', 'content_key', 'value', 'is_published', 'updated_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];
}
