<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextbookLoanItem extends Model
{
    protected $fillable = [
        'loan_id', 'member_id', 'textbook_item_id',
        'kondisi_pinjam', 'kondisi_kembali', 'status_sanksi', 'tgl_kembali_aktual',
    ];

    protected $casts = [
        'tgl_kembali_aktual' => 'date',
    ];

    public function loan()
    {
        return $this->belongsTo(TextbookLoan::class, 'loan_id');
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
