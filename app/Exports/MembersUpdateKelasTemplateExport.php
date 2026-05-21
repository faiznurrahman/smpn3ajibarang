<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersUpdateKelasTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            ['23001', '8A'],
            ['23002', '8B'],
        ];
    }

    public function headings(): array
    {
        return ['kode_anggota', 'kelas_baru'];
    }
}
