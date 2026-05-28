<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'sejarah',
        'foto_sejarah',
        'foto_sejarah_alt',
        'visi',
        'misi',
    ];
}
