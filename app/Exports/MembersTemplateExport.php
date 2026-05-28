<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembersTemplateExport implements FromArray, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function array(): array
    {
        return [
            // Contoh baris 1
            ['23001', 'Budi Santoso', '7A', 2025, '081234567890'],
            // Contoh baris 2
            ['23002', 'Siti Rahayu', '7B', 2025, ''],
            // Baris kosong untuk diisi
            array_fill(0, 5, ''),
            array_fill(0, 5, ''),
            array_fill(0, 5, ''),
        ];
    }

    public function headings(): array
    {
        // Kolom yang diimport: nis, nama, kelas, angkatan, no_hp
        // - nis       : NIS siswa (wajib, harus unik)
        // - nama      : Nama lengkap (wajib)
        // - kelas     : Contoh: 7A, 7B, 7C (wajib)
        // - angkatan  : Tahun masuk sekolah, contoh: 2025 (wajib)
        // - no_hp     : Nomor HP/WA (opsional)
        return ['nis', 'nama', 'kelas', 'angkatan', 'no_hp'];
    }

    public function title(): string
    {
        return 'Template Import Anggota';
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FF1E3A8A']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFE8EFFF']],
                'alignment' => ['wrapText' => true],
            ],
            2 => ['font' => ['italic' => true, 'color' => ['argb' => 'FF64748B']]],
            3 => ['font' => ['italic' => true, 'color' => ['argb' => 'FF64748B']]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 14,  // nis
            'B' => 32,  // nama
            'C' => 10,  // kelas
            'D' => 12,  // angkatan
            'E' => 18,  // no_hp
        ];
    }
}
