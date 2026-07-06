<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextbookDistributionItem extends Model
{
    protected $table = 'textbook_distribution_items';

    protected $fillable = [
        'distribution_id', 'member_id', 'textbook_item_id',
        'urutan_distribusi', 'kondisi_kembali',
        'jenis_sanksi', 'nominal_sanksi', 'status_sanksi',
        'tgl_kembali_aktual', 'catatan',
    ];

    protected $casts = [
        'tgl_kembali_aktual' => 'date',
        'urutan_distribusi'  => 'integer',
        'nominal_sanksi'     => 'integer',
    ];

    public function distribution()
    {
        return $this->belongsTo(TextbookDistribution::class, 'distribution_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function textbookItem()
    {
        return $this->belongsTo(TextbookItem::class, 'textbook_item_id');
    }
}
