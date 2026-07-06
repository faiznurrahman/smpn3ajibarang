<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembersUpdateKelasTemplateExport implements FromCollection, WithMapping, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Member::query()
            ->where('jenis', 'siswa')
            ->where('status', 'aktif')
            ->whereNotNull('kelas')
            ->orderBy('tahun_masuk')
            ->orderBy('kelas')
            ->orderBy('nama')
            ->get(['kode_anggota', 'nama', 'kelas']);
    }

    /** @param \App\Models\Member $member */
    public function map($member): array
    {
        return [
            $member->kode_anggota,  // nis (wajib saat import)
            $member->nama,          // nama (referensi, diabaikan saat import)
            $member->kelas,         // kelas_sekarang (referensi, diabaikan saat import)
            '',                     // kelas_baru (wajib diisi admin)
        ];
    }

    public function headings(): array
    {
        // Saat import, kolom yang dibaca: nis dan kelas_baru
        // Kolom nama dan kelas_sekarang hanya referensi (tidak diimport)
        return ['nis', 'nama', 'kelas_sekarang', 'kelas_baru'];
    }

    public function title(): string
    {
        return 'Update Kelas Anggota';
    }

    public function styles(Worksheet $sheet): array
    {
        $lastRow = max($sheet->getHighestRow(), 2);

        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FF1E3A8A']],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFE8EFFF']],
                'alignment' => ['wrapText' => true],
            ],
            // Kolom C (kelas_sekarang) — abu-abu, hanya referensi
            "C2:C{$lastRow}" => [
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFF1F5F9']],
                'font' => ['color' => ['argb' => 'FF94A3B8']],
            ],
            // Kolom D (kelas_baru) — highlight kuning untuk diisi
            "D2:D{$lastRow}" => [
                'fill' => ['fillType' => 'solid', 'startColor' => ['argb' => 'FFFFF7CC']],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 14,  // nis
            'B' => 32,  // nama
            'C' => 16,  // kelas_sekarang
            'D' => 14,  // kelas_baru
        ];
    }
}
