<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Textbook extends Model
{
    protected $fillable = [
        'judul', 'mata_pelajaran', 'untuk_tingkat', 'kode_prefix',
        'penerbit', 'tahun_terbit', 'total_eksemplar', 'is_active',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'total_eksemplar' => 'integer',
        'untuk_tingkat'   => 'integer',
    ];

    public function items()
    {
        return $this->hasMany(TextbookItem::class);
    }

    public function loans()
    {
        return $this->hasManyThrough(TextbookLoanItem::class, TextbookItem::class, 'textbook_id', 'textbook_item_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    public function generateItems(): void
    {
        for ($i = 1; $i <= $this->total_eksemplar; $i++) {
            TextbookItem::create([
                'textbook_id'  => $this->id,
                'kode_item'    => $this->kode_prefix . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'kondisi'      => 'baik',
                'is_available' => true,
            ]);
        }
    }
}
