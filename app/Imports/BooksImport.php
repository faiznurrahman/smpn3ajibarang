<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BooksImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    private int $imported = 0;

    public function model(array $row): ?Book
    {
        // Skip row if kode_buku already exists
        if (!empty($row['kode_buku']) && Book::where('kode_buku', trim($row['kode_buku']))->exists()) {
            return null;
        }

        $this->imported++;

        return new Book([
            'kode_buku' => !empty($row['kode_buku']) ? trim($row['kode_buku']) : null,
            'isbn'      => !empty($row['isbn'])      ? trim($row['isbn'])      : null,
            'judul'     => trim($row['judul']),
            'penulis'   => trim($row['penulis']),
            'penerbit'  => !empty($row['penerbit'])  ? trim($row['penerbit'])  : null,
            'tahun'     => !empty($row['tahun'])     ? (int) $row['tahun']     : null,
            'kategori'  => !empty($row['kategori'])  ? trim($row['kategori'])  : null,
            'rak'       => !empty($row['rak'])       ? trim($row['rak'])       : null,
            'stok'      => !empty($row['stok'])      ? (int) $row['stok']      : 1,
            'deskripsi' => !empty($row['deskripsi']) ? trim($row['deskripsi']) : null,
            'is_active' => isset($row['status']) && strtolower(trim($row['status'])) === 'nonaktif' ? false : true,
        ]);
    }

    public function rules(): array
    {
        return [
            'judul'   => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'stok'    => 'nullable|integer|min:0',
            'tahun'   => 'nullable|integer|min:1900|max:' . date('Y'),
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'judul.required'   => 'Kolom judul wajib diisi.',
            'penulis.required' => 'Kolom penulis wajib diisi.',
        ];
    }

    public function getImported(): int
    {
        return $this->imported;
    }

    public function getFailureCount(): int
    {
        return count($this->failures());
    }
}
