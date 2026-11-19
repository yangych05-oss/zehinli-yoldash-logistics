<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteMediaItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'collection', 'kind', 'slot', 'file_path', 'poster_path',
        'caption_ru', 'caption_tm', 'caption_en', 'is_published', 'updated_by',
    ];

    protected $casts = [
        'slot' => 'integer',
        'is_published' => 'boolean',
    ];
}
