<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextbookDistribution extends Model
{
    protected $table = 'textbook_distributions';

    protected $fillable = [
        'tahun_ajaran', 'untuk_tingkat', 'tgl_distribusi',
        'tgl_kembali_rencana', 'status', 'petugas_id',
    ];

    protected $casts = [
        'tgl_distribusi'      => 'date',
        'tgl_kembali_rencana' => 'date',
        'untuk_tingkat'       => 'integer',
    ];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function distributionItems()
    {
        return $this->hasMany(TextbookDistributionItem::class, 'distribution_id');
    }

    public function getJumlahSiswaAttribute(): int
    {
        return $this->distributionItems()->distinct('member_id')->count('member_id');
    }

    public function getJumlahKembaliAttribute(): int
    {
        return $this->distributionItems()->whereNotNull('tgl_kembali_aktual')->count();
    }
}
