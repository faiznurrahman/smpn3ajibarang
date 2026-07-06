<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookItem;
use Illuminate\Database\Seeder;

class BookItemSeeder extends Seeder
{
    public function run(): void
    {
        BookItem::query()->delete();

        foreach (Book::where('is_active', true)->get() as $book) {
            for ($i = 0; $i < $book->stok; $i++) {
                BookItem::create([
                    'book_id'      => $book->id,
                    'kondisi'      => 'baik',
                    'is_available' => true,
                ]);
            }
        }
    }
}
