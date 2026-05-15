<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = [
        'loan_id', 'jumlah_hari', 'nominal', 'status_bayar', 'tgl_bayar',
    ];

    protected $casts = [
        'tgl_bayar'   => 'date',
        'jumlah_hari' => 'integer',
        'nominal'     => 'integer',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
