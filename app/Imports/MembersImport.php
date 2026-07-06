<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersImport implements ToCollection, WithHeadingRow
{
    public int $imported = 0;
    public int $skipped  = 0;

    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $row  = $row->toArray();
            $nis  = trim($row['nis'] ?? '');
            $nama = trim($row['nama'] ?? '');

            if ($nis === '' || $nama === '') {
                $this->skipped++;
                continue;
            }

            // Skip jika NIS sudah ada
            if (Member::where('kode_anggota', $nis)->exists()) {
                $this->skipped++;
                continue;
            }

            $kelas   = trim($row['kelas'] ?? '');
            $angkatan = !empty($row['angkatan']) ? (int) $row['angkatan'] : null;

            try {
                Member::create([
                    'kode_anggota' => $nis,
                    'nama'         => $nama,
                    'jenis'        => 'siswa',
                    'kelas'        => $kelas ?: null,
                    'tahun_masuk'  => $angkatan,
                    'status'       => 'aktif',
                    'is_active'    => true,
                ]);
                $this->imported++;
            } catch (\Throwable) {
                $this->skipped++;
            }
        }
    }
}
