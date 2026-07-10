<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KioskProfile extends Model
{
    protected $fillable = [
        'sejarah',
        'tagline',
        'hero_image',
        'pengelola',
        'galeri',
        'kontak_alamat',
        'kontak_telepon',
        'kontak_email',
    ];

    protected $casts = [
        'pengelola' => 'array',
        'galeri'    => 'array',
    ];
}
