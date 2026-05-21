<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            ['23001', 'Budi Santoso', 'siswa', '2023', '7A', '08123456789', 'aktif'],
        ];
    }

    public function headings(): array
    {
        return ['kode_anggota', 'nama', 'jenis', 'tahun_masuk', 'kelas', 'no_hp', 'status'];
    }
}
