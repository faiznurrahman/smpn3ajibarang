<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'alamat',
        'nomor_telepon',
        'email',
        'website',
        'embed_maps',
    ];
}
