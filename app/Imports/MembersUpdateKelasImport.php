<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersUpdateKelasImport implements ToCollection, WithHeadingRow
{
    public int   $updated      = 0;
    public int   $notFound     = 0;
    public array $notFoundList = [];

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $row       = $row->toArray();
            $nis       = trim($row['nis'] ?? '');
            $kelasBaru = trim($row['kelas_baru'] ?? '');

            // Kolom nama & kelas_sekarang hanya referensi, diabaikan
            if ($nis === '' || $kelasBaru === '') {
                continue;
            }

            $member = Member::where('kode_anggota', $nis)->first();

            if (! $member) {
                $this->notFound++;
                $this->notFoundList[] = $nis;
                continue;
            }

            $member->update(['kelas' => $kelasBaru]);
            $this->updated++;
        }
    }
}
