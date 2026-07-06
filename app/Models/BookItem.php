<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookItem extends Model
{
    protected $fillable = [
        'book_id', 'kode_item', 'kondisi', 'is_available', 'catatan',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($item) {
            if (empty($item->kode_item)) {
                $book   = Book::find($item->book_id);
                $next   = static::where('book_id', $item->book_id)->count() + 1;
                $item->kode_item = $book->kode_buku . '-' . str_pad($next, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
