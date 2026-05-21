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
            $row = $row->toArray();

            $kode = trim($row['kode_anggota'] ?? '');
            $nama = trim($row['nama'] ?? '');

            if ($kode === '' || $nama === '') {
                continue;
            }

            if (Member::where('kode_anggota', $kode)->exists()) {
                $this->skipped++;
                continue;
            }

            $jenisRaw = strtolower(trim($row['jenis'] ?? ''));
            $jenis    = in_array($jenisRaw, ['siswa', 'guru']) ? $jenisRaw : 'siswa';

            $statusRaw = strtolower(trim($row['status'] ?? ''));
            $status    = in_array($statusRaw, ['aktif', 'lulus', 'pindah', 'keluar']) ? $statusRaw : 'aktif';

            try {
                Member::create([
                    'kode_anggota' => $kode,
                    'nama'         => $nama,
                    'jenis'        => $jenis,
                    'tahun_masuk'  => ($row['tahun_masuk'] ?? '') !== '' ? (int) $row['tahun_masuk'] : null,
                    'kelas'        => ($row['kelas'] ?? '') !== '' ? $row['kelas'] : null,
                    'no_hp'        => ($row['no_hp'] ?? '') !== '' ? $row['no_hp'] : null,
                    'status'       => $status,
                    'is_active'    => true,
                ]);
                $this->imported++;
            } catch (\Throwable) {
                $this->skipped++;
            }
        }
    }
}
