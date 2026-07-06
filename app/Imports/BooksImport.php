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
    private int $skipped  = 0;

    public function model(array $row): ?Book
    {
        if (!empty($row['kode_buku']) && Book::where('kode_buku', trim($row['kode_buku']))->exists()) {
            $this->skipped++;
            return null;
        }

        $this->imported++;

        return new Book([
            'kode_buku'           => !empty($row['kode_buku'])           ? trim($row['kode_buku'])           : null,
            'no_panggil'          => !empty($row['no_panggil'])          ? trim($row['no_panggil'])          : null,
            'isbn'                => !empty($row['isbn'])                ? trim($row['isbn'])                : null,
            'judul'               => trim($row['judul']),
            'anak_judul'          => !empty($row['anak_judul'])          ? trim($row['anak_judul'])          : null,
            'penulis'             => trim($row['penulis']),
            'pengarang_tambahan'  => !empty($row['pengarang_tambahan'])  ? trim($row['pengarang_tambahan'])  : null,
            'penerbit'            => !empty($row['penerbit'])            ? trim($row['penerbit'])            : null,
            'tahun'               => !empty($row['tahun'])               ? (int) $row['tahun']               : null,
            'edisi'               => !empty($row['edisi'])               ? trim($row['edisi'])               : null,
            'kota_terbit'         => !empty($row['kota_terbit'])         ? trim($row['kota_terbit'])         : null,
            'deskripsi_fisik'     => !empty($row['deskripsi_fisik'])     ? trim($row['deskripsi_fisik'])     : null,
            'jumlah_halaman'      => !empty($row['jumlah_halaman'])      ? (int) $row['jumlah_halaman']      : null,
            'dimensi'             => !empty($row['dimensi'])             ? trim($row['dimensi'])             : null,
            'bahasa'              => !empty($row['bahasa'])              ? trim($row['bahasa'])              : 'ind',
            'bentuk_karya'        => !empty($row['bentuk_karya'])        ? trim($row['bentuk_karya'])        : null,
            'sumber'              => !empty($row['sumber'])              ? trim($row['sumber'])              : null,
            'tgl_masuk'           => !empty($row['tgl_masuk'])           ? $row['tgl_masuk']                 : null,
            'harga'               => !empty($row['harga'])               ? (int) $row['harga']               : null,
            'kategori'            => !empty($row['kategori'])            ? trim($row['kategori'])            : null,
            'rak'                 => !empty($row['rak'])                 ? trim($row['rak'])                 : null,
            'stok'                => !empty($row['stok'])                ? (int) $row['stok']                : 1,
            'deskripsi'           => !empty($row['deskripsi'])           ? trim($row['deskripsi'])           : null,
            'is_active'           => isset($row['status']) && strtolower(trim($row['status'])) === 'nonaktif' ? false : true,
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

    public function getSkipped(): int
    {
        return $this->skipped;
    }

    public function getFailureCount(): int
    {
        return count($this->failures());
    }
}
