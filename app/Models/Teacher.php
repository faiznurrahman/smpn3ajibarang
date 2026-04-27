<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
    'nama',
    'foto',
    'jenis',
    'jabatan',
    'mapel',
    'is_active',
    'order',
];

protected $casts = [
    'is_active' => 'boolean',
];
}
