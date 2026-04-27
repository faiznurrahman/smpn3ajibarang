<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoProfile extends Model
{
     protected $fillable = [
        'judul',
        'link_video',
        'deskripsi',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
