<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BooksTemplateExport implements FromArray, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function array(): array
    {
        return [
            // Contoh baris data (24 kolom)
            ['', '', '978-602-1234-56-7', 'Matematika Kelas 7', '', 'Kusnandar', '', 'Erlangga', 2022, '', 'Jakarta', '', 256, '14.8 x 21 cm', 'ind', '0', 'beli', '2024-01-15', '', 'Pelajaran', 'Rak A-1', 5, 'Buku pelajaran matematika kelas 7 SMP.', 'aktif'],
            array_fill(0, 24, ''),
            array_fill(0, 24, ''),
            array_fill(0, 24, ''),
            array_fill(0, 24, ''),
        ];
    }

    public function headings(): array
    {
        return [
            'kode_buku',          // Kosongkan → auto-generate (BK-XXXX)
            'no_panggil',
            'isbn',
            'judul',              // WAJIB
            'anak_judul',
            'penulis',            // WAJIB
            'pengarang_tambahan', // Editor / Penerjemah / Ilustrator
            'penerbit',
            'tahun',
            'edisi',
            'kota_terbit',
            'deskripsi_fisik',    // Legacy — gunakan jumlah_halaman + dimensi
            'jumlah_halaman',     // Angka saja, contoh: 256
            'dimensi',            // Contoh: 14.8 x 21 cm
            'bahasa',             // Kode: ind / eng / ara / chi / dut / fre / ger / jpn / may / per / rsa / spa
            'bentuk_karya',       // 0=Bukan Fiksi / 1=Fiksi Umum / f=Novel / j=Cerpen / d=Drama / p=Puisi / e=Esai / |=Lainnya
            'sumber',             // beli / hibah / sumbangan
            'tgl_masuk',          // Format: YYYY-MM-DD
            'harga',
            'kategori',           // Fiksi / Non-Fiksi / Pelajaran / Referensi / Ensiklopedi / Biografi / Sains & Teknologi / Sosial & Budaya / Agama / Lainnya
            'rak',
            'stok',               // Default: 1
            'deskripsi',
            'status',             // aktif / nonaktif  (default: aktif)
        ];
    }

    public function title(): string
    {
        return 'Template Import Buku';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FF1E3A8A']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFE8EFFF']],
                'alignment' => ['wrapText' => true],
            ],
            2 => [
                'font' => ['italic' => true, 'color' => ['argb' => 'FF64748B']],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 14,  // kode_buku
            'B' => 14,  // no_panggil
            'C' => 22,  // isbn
            'D' => 38,  // judul
            'E' => 30,  // anak_judul
            'F' => 25,  // penulis
            'G' => 28,  // pengarang_tambahan
            'H' => 20,  // penerbit
            'I' => 10,  // tahun
            'J' => 14,  // edisi
            'K' => 16,  // kota_terbit
            'L' => 26,  // deskripsi_fisik
            'M' => 16,  // jumlah_halaman
            'N' => 20,  // dimensi
            'O' => 14,  // bahasa
            'P' => 16,  // bentuk_karya
            'Q' => 14,  // sumber
            'R' => 16,  // tgl_masuk
            'S' => 14,  // harga
            'T' => 20,  // kategori
            'U' => 14,  // rak
            'V' => 8,   // stok
            'W' => 40,  // deskripsi
            'X' => 12,  // status
        ];
    }
}
