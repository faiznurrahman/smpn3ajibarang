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
            // Example row
            ['', '978-602-1234-56-7', 'Matematika Kelas 7', 'Kusnandar', 'Erlangga', 2022, 'Pelajaran', 'Rak A-1', 5, 'Buku pelajaran matematika untuk kelas 7 SMP.', 'aktif'],
            // Blank rows for data entry
            array_fill(0, 11, ''),
            array_fill(0, 11, ''),
            array_fill(0, 11, ''),
            array_fill(0, 11, ''),
        ];
    }

    public function headings(): array
    {
        return [
            'kode_buku',   // Kosongkan → auto-generate. Isi jika ingin kode spesifik.
            'isbn',
            'judul',       // WAJIB
            'penulis',     // WAJIB
            'penerbit',
            'tahun',
            'kategori',    // Fiksi / Non-Fiksi / Pelajaran / Referensi / Ensiklopedi / Biografi / Sains & Teknologi / Sosial & Budaya / Agama / Lainnya
            'rak',
            'stok',        // Default: 1
            'deskripsi',
            'status',      // aktif / nonaktif  (default: aktif)
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
            'B' => 22,  // isbn
            'C' => 38,  // judul
            'D' => 25,  // penulis
            'E' => 20,  // penerbit
            'F' => 10,  // tahun
            'G' => 20,  // kategori
            'H' => 14,  // rak
            'I' => 8,   // stok
            'J' => 40,  // deskripsi
            'K' => 12,  // status
        ];
    }
}
