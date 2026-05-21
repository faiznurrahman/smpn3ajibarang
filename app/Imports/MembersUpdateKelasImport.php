<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersUpdateKelasImport implements ToModel, WithHeadingRow
{
    public int   $updated      = 0;
    public int   $notFound     = 0;
    public array $notFoundList = [];

    public function model(array $row): ?Member
    {
        $member = Member::where('kode_anggota', $row['kode_anggota'])->first();

        if (! $member) {
            $this->notFound++;
            $this->notFoundList[] = $row['kode_anggota'];
            return null;
        }

        $member->update([
            'kelas' => $row['kelas_baru'],
        ]);

        $this->updated++;

        return null;
    }
}
