<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteVisit extends Model
{
    public $timestamps = false;

    protected $fillable = ['halaman', 'ip_address', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
