<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Fine;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Fine::truncate();
        Loan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $petugasId = User::where('email', 'petugas@smpn3ajibarang.sch.id')->value('id') ?? 1;

        $books   = Book::where('is_active', true)->orderBy('id')->get()->values();
        $members = Member::siswa()->aktif()->orderBy('kode_anggota')->get()->values();

        if ($members->isEmpty() || $books->isEmpty()) {
            return;
        }

        // ── 10 Active Loans (dipinjam) — each uses a different book ───────────
        $activeLoans = [
            ['mi' => 0,  'bi' => 0,  'pinjam' => '2026-05-28', 'batas' => '2026-06-11'],
            ['mi' => 1,  'bi' => 1,  'pinjam' => '2026-05-25', 'batas' => '2026-06-08'],
            ['mi' => 2,  'bi' => 2,  'pinjam' => '2026-06-01', 'batas' => '2026-06-15'],
            ['mi' => 3,  'bi' => 3,  'pinjam' => '2026-06-02', 'batas' => '2026-06-16'],
            ['mi' => 4,  'bi' => 4,  'pinjam' => '2026-05-30', 'batas' => '2026-06-13'],
            ['mi' => 5,  'bi' => 5,  'pinjam' => '2026-06-03', 'batas' => '2026-06-17'],
            ['mi' => 6,  'bi' => 6,  'pinjam' => '2026-06-04', 'batas' => '2026-06-18'],
            ['mi' => 7,  'bi' => 7,  'pinjam' => '2026-05-27', 'batas' => '2026-06-10'],
            ['mi' => 20, 'bi' => 8,  'pinjam' => '2026-06-05', 'batas' => '2026-06-19'],
            ['mi' => 21, 'bi' => 9,  'pinjam' => '2026-06-06', 'batas' => '2026-06-20'],
        ];

        foreach ($activeLoans as $loan) {
            if (! isset($members[$loan['mi']]) || ! isset($books[$loan['bi']])) continue;
            Loan::create([
                'book_id'          => $books[$loan['bi']]->id,
                'member_id'        => $members[$loan['mi']]->id,
                'tgl_pinjam'       => $loan['pinjam'],
                'tgl_batas_kembali'=> $loan['batas'],
                'status'           => 'dipinjam',
                'kondisi_kembali'  => null,
                'jenis_sanksi'     => 'tidak_ada',
                'status_sanksi'    => 'tidak_ada',
                'petugas_id'       => $petugasId,
            ]);
        }

        // ── 3 Overdue (terlambat) — belum dikembalikan ────────────────────────
        $overdueLoans = [
            ['mi' => 8,  'bi' => 10, 'pinjam' => '2026-05-01', 'batas' => '2026-05-15'],
            ['mi' => 9,  'bi' => 11, 'pinjam' => '2026-05-05', 'batas' => '2026-05-19'],
            ['mi' => 10, 'bi' => 12, 'pinjam' => '2026-05-08', 'batas' => '2026-05-22'],
        ];

        foreach ($overdueLoans as $loan) {
            if (! isset($members[$loan['mi']]) || ! isset($books[$loan['bi']])) continue;
            Loan::create([
                'book_id'          => $books[$loan['bi']]->id,
                'member_id'        => $members[$loan['mi']]->id,
                'tgl_pinjam'       => $loan['pinjam'],
                'tgl_batas_kembali'=> $loan['batas'],
                'status'           => 'terlambat',
                'kondisi_kembali'  => null,
                'jenis_sanksi'     => 'tidak_ada',
                'status_sanksi'    => 'tidak_ada',
                'petugas_id'       => $petugasId,
            ]);
        }

        // ── 8 Returned Normally (dikembalikan, kondisi baik) ──────────────────
        $returnedNormal = [
            ['mi' => 11, 'bi' => 13, 'pinjam' => '2026-04-01', 'batas' => '2026-04-15', 'kembali' => '2026-04-14'],
            ['mi' => 12, 'bi' => 14, 'pinjam' => '2026-04-05', 'batas' => '2026-04-19', 'kembali' => '2026-04-18'],
            ['mi' => 13, 'bi' => 15, 'pinjam' => '2026-04-10', 'batas' => '2026-04-24', 'kembali' => '2026-04-23'],
            ['mi' => 14, 'bi' => 16, 'pinjam' => '2026-04-15', 'batas' => '2026-04-29', 'kembali' => '2026-04-28'],
            ['mi' => 15, 'bi' => 17, 'pinjam' => '2026-03-10', 'batas' => '2026-03-24', 'kembali' => '2026-03-22'],
            ['mi' => 16, 'bi' => 18, 'pinjam' => '2026-03-15', 'batas' => '2026-03-29', 'kembali' => '2026-03-28'],
            ['mi' => 17, 'bi' => 19, 'pinjam' => '2026-03-20', 'batas' => '2026-04-03', 'kembali' => '2026-04-02'],
            ['mi' => 18, 'bi' => 20, 'pinjam' => '2026-02-10', 'batas' => '2026-02-24', 'kembali' => '2026-02-20'],
        ];

        foreach ($returnedNormal as $loan) {
            if (! isset($members[$loan['mi']]) || ! isset($books[$loan['bi']])) continue;
            Loan::create([
                'book_id'          => $books[$loan['bi']]->id,
                'member_id'        => $members[$loan['mi']]->id,
                'tgl_pinjam'       => $loan['pinjam'],
                'tgl_batas_kembali'=> $loan['batas'],
                'tgl_kembali'      => $loan['kembali'],
                'status'           => 'dikembalikan',
                'kondisi_kembali'  => 'baik',
                'jenis_sanksi'     => 'tidak_ada',
                'status_sanksi'    => 'tidak_ada',
                'petugas_id'       => $petugasId,
            ]);
        }

        // ── 5 Returned Late — ada denda ───────────────────────────────────────
        $lateFines = [
            ['mi' => 22, 'bi' => 21, 'pinjam' => '2026-04-01', 'batas' => '2026-04-08', 'kembali' => '2026-04-13', 'hari' => 5,  'lunas' => true],
            ['mi' => 23, 'bi' => 22, 'pinjam' => '2026-04-05', 'batas' => '2026-04-12', 'kembali' => '2026-04-20', 'hari' => 8,  'lunas' => true],
            ['mi' => 24, 'bi' => 23, 'pinjam' => '2026-03-20', 'batas' => '2026-03-27', 'kembali' => '2026-04-05', 'hari' => 9,  'lunas' => false],
            ['mi' => 25, 'bi' => 24, 'pinjam' => '2026-05-05', 'batas' => '2026-05-12', 'kembali' => '2026-05-18', 'hari' => 6,  'lunas' => false],
            ['mi' => 26, 'bi' => 0,  'pinjam' => '2026-02-01', 'batas' => '2026-02-08', 'kembali' => '2026-02-22', 'hari' => 14, 'lunas' => true],
        ];

        foreach ($lateFines as $loan) {
            if (! isset($members[$loan['mi']]) || ! isset($books[$loan['bi']])) continue;
            $created = Loan::create([
                'book_id'          => $books[$loan['bi']]->id,
                'member_id'        => $members[$loan['mi']]->id,
                'tgl_pinjam'       => $loan['pinjam'],
                'tgl_batas_kembali'=> $loan['batas'],
                'tgl_kembali'      => $loan['kembali'],
                'status'           => 'dikembalikan',
                'kondisi_kembali'  => 'baik',
                'jenis_sanksi'     => 'tidak_ada',
                'status_sanksi'    => 'tidak_ada',
                'petugas_id'       => $petugasId,
            ]);

            Fine::create([
                'loan_id'     => $created->id,
                'jumlah_hari' => $loan['hari'],
                'nominal'     => $loan['hari'] * 1000,
                'status_bayar'=> $loan['lunas'] ? 'lunas' : 'belum_lunas',
                'tgl_bayar'   => $loan['lunas'] ? $loan['kembali'] : null,
            ]);
        }

        // ── 3 Returned with Sanctions ─────────────────────────────────────────
        $withSanksi = [
            [
                'mi' => 27, 'bi' => 1, 'pinjam' => '2026-03-01', 'batas' => '2026-03-15', 'kembali' => '2026-03-15',
                'kondisi' => 'rusak', 'jenis_sanksi' => 'bayar_harga', 'nominal' => 75000,
                'status_sanksi' => 'lunas', 'tgl_sanksi' => '2026-03-20',
            ],
            [
                'mi' => 28, 'bi' => 2, 'pinjam' => '2026-04-01', 'batas' => '2026-04-15', 'kembali' => '2026-04-15',
                'kondisi' => 'hilang', 'jenis_sanksi' => 'ganti_buku', 'nominal' => 0,
                'status_sanksi' => 'belum_lunas', 'tgl_sanksi' => null,
            ],
            [
                'mi' => 29, 'bi' => 3, 'pinjam' => '2026-05-01', 'batas' => '2026-05-15', 'kembali' => '2026-05-15',
                'kondisi' => 'rusak', 'jenis_sanksi' => 'bayar_harga', 'nominal' => 50000,
                'status_sanksi' => 'belum_lunas', 'tgl_sanksi' => null,
            ],
        ];

        foreach ($withSanksi as $loan) {
            if (! isset($members[$loan['mi']]) || ! isset($books[$loan['bi']])) continue;
            Loan::create([
                'book_id'            => $books[$loan['bi']]->id,
                'member_id'          => $members[$loan['mi']]->id,
                'tgl_pinjam'         => $loan['pinjam'],
                'tgl_batas_kembali'  => $loan['batas'],
                'tgl_kembali'        => $loan['kembali'],
                'status'             => 'dikembalikan',
                'kondisi_kembali'    => $loan['kondisi'],
                'jenis_sanksi'       => $loan['jenis_sanksi'],
                'nominal_sanksi'     => $loan['nominal'],
                'status_sanksi'      => $loan['status_sanksi'],
                'tgl_selesai_sanksi' => $loan['tgl_sanksi'],
                'catatan_sanksi'     => 'Buku ' . $loan['kondisi'] . ' saat dikembalikan.',
                'petugas_id'         => $petugasId,
            ]);
        }
    }
}
