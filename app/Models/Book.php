<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'kode_buku', 'no_panggil', 'isbn', 'judul', 'anak_judul', 'penulis', 'pengarang_tambahan',
        'penerbit', 'tahun', 'edisi', 'kota_terbit', 'deskripsi_fisik', 'jumlah_halaman', 'dimensi',
        'bentuk_karya', 'bahasa', 'sumber', 'tgl_masuk', 'harga',
        'kategori', 'rak', 'stok', 'cover', 'deskripsi', 'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'stok'           => 'integer',
        'tahun'          => 'integer',
        'harga'          => 'integer',
        'jumlah_halaman' => 'integer',
        'tgl_masuk'      => 'date',
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

    public function bookItems()
    {
        return $this->hasMany(BookItem::class);
    }

    public function generateItems(int $jumlah = 1, string $kondisi = 'baik'): void
    {
        for ($i = 0; $i < $jumlah; $i++) {
            $this->bookItems()->create([
                'kondisi'      => $kondisi,
                'is_available' => true,
            ]);
        }
    }

    public function getJumlahEksemplarAttribute(): int
    {
        return $this->bookItems()->count();
    }

    public function getEksemplarTersediaAttribute(): int
    {
        return $this->bookItems()->where('is_available', true)->count();
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
