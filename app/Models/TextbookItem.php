<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextbookItem extends Model
{
    protected $fillable = [
        'textbook_id', 'kode_item', 'kondisi', 'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function textbook()
    {
        return $this->belongsTo(Textbook::class);
    }

    public function loanItems()
    {
        return $this->hasMany(TextbookLoanItem::class, 'textbook_item_id');
    }
}
