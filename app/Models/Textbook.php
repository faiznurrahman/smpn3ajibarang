<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Textbook extends Model
{
    protected $fillable = [
        'judul', 'anak_judul', 'mata_pelajaran', 'untuk_tingkat', 'kode_prefix',
        'penerbit', 'kota_terbit', 'tahun_terbit', 'total_eksemplar',
        'deskripsi', 'harga', 'cover', 'is_active',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'total_eksemplar' => 'integer',
        'untuk_tingkat'   => 'integer',
        'harga'           => 'integer',
    ];

    protected static function booted(): void
    {
        static::created(function (Textbook $textbook) {
            for ($i = 0; $i < $textbook->total_eksemplar; $i++) {
                TextbookItem::create([
                    'textbook_id'  => $textbook->id,
                    'kondisi'      => 'baik',
                    'is_available' => true,
                ]);
            }
        });
    }

    public function items()
    {
        return $this->hasMany(TextbookItem::class);
    }

    public function generateItems(int $jumlah = 1, string $kondisi = 'baik'): void
    {
        for ($i = 0; $i < $jumlah; $i++) {
            $this->items()->create([
                'kondisi'      => $kondisi,
                'is_available' => true,
            ]);
        }
    }

    public function getEksemplarTersediaAttribute(): int
    {
        return $this->items()->where('is_available', true)->count();
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }
}
