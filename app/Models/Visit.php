<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'nama', 'jenis_pengunjung', 'kelas', 'keperluan', 'tgl_kunjungan', 'jam_kunjungan',
    ];

    protected $casts = [
        'tgl_kunjungan' => 'date',
        'jam_kunjungan' => 'string',
    ];
}
