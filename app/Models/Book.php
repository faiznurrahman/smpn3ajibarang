<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'kode_buku', 'isbn', 'judul', 'penulis', 'penerbit', 'tahun',
        'kategori', 'rak', 'stok', 'cover', 'deskripsi', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'stok'      => 'integer',
        'tahun'     => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function ($book) {
            if (empty($book->kode_buku)) {
                $next = (static::max('id') ?? 0) + 1;
                $book->kode_buku = 'BK-' . str_pad($next, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoans()
    {
        return $this->hasMany(Loan::class)->where('status', 'dipinjam');
    }

    public function getStokTersediaAttribute(): int
    {
        return max(0, $this->stok - $this->activeLoans()->count());
    }

    public function getStokDipinjamAttribute(): int
    {
        return $this->activeLoans()->count();
    }
}
