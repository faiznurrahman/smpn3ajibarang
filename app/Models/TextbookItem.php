<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextbookItem extends Model
{
    protected $fillable = [
        'textbook_id', 'kode_item', 'kondisi', 'is_available', 'catatan',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (TextbookItem $item) {
            if (blank($item->kode_item)) {
                $textbook = Textbook::find($item->textbook_id);
                $prefix   = $textbook?->kode_prefix ?? 'BP';
                $existing = static::where('textbook_id', $item->textbook_id)->count();
                $item->kode_item = $prefix . '-' . str_pad($existing + 1, 5, '0', STR_PAD_LEFT);
            }
        });
    }

    public function textbook()
    {
        return $this->belongsTo(Textbook::class);
    }

    public function distributionItems()
    {
        return $this->hasMany(TextbookDistributionItem::class, 'textbook_item_id');
    }
}
