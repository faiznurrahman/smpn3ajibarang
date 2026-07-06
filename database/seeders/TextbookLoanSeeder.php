<?php

namespace Database\Seeders;

use App\Models\Textbook;
use App\Models\TextbookLoan;
use App\Models\TextbookLoanItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TextbookLoanSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TextbookLoanItem::truncate();
        TextbookLoan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Also reset textbook_items back to available (in case LoanSeeder ran after TextbookSeeder)
        DB::table('textbook_items')->update(['is_available' => true]);

        $petugasId = User::where('email', 'petugas@smpn3ajibarang.sch.id')->value('id') ?? 1;

        $distributions = [
            ['tingkat' => 7, 'tgl_distribusi' => '2025-07-15', 'tgl_kembali' => '2026-06-30', 'status' => 'aktif'],
            ['tingkat' => 8, 'tgl_distribusi' => '2025-07-15', 'tgl_kembali' => '2026-06-30', 'status' => 'aktif'],
            ['tingkat' => 9, 'tgl_distribusi' => '2024-07-15', 'tgl_kembali' => '2025-06-30', 'status' => 'selesai'],
        ];

        foreach ($distributions as $dist) {
            $textbookIds = Textbook::where('untuk_tingkat', $dist['tingkat'])
                ->where('is_active', true)
                ->pluck('id')
                ->toArray();

            if (empty($textbookIds)) continue;

            $tl = TextbookLoan::create([
                'tahun_ajaran'   => $dist['tingkat'] === 9 ? '2024/2025' : '2025/2026',
                'untuk_tingkat'  => $dist['tingkat'],
                'tgl_distribusi' => $dist['tgl_distribusi'],
                'tgl_kembali'    => $dist['tgl_kembali'],
                'status'         => $dist['status'],
                'petugas_id'     => $petugasId,
            ]);

            $tl->distributeToMembers($textbookIds);

            // For grade 9 (selesai): mark all items as returned with kondisi_kembali
            if ($dist['tingkat'] === 9) {
                $items = TextbookLoanItem::where('loan_id', $tl->id)->get();
                foreach ($items as $i => $item) {
                    $kondisi = $i % 10 === 0 ? 'rusak' : 'baik'; // 1 in 10 returned rusak
                    $item->update([
                        'kondisi_kembali'    => $kondisi,
                        'tgl_kembali_aktual' => '2025-06-25',
                        'jenis_sanksi'       => $kondisi === 'rusak' ? 'bayar_harga' : null,
                        'status_sanksi'      => $kondisi === 'rusak' ? 'belum_lunas' : 'tidak_ada',
                        'nominal_sanksi'     => $kondisi === 'rusak' ? 50000 : null,
                        'catatan_sanksi'     => $kondisi === 'rusak' ? 'Buku rusak saat dikembalikan.' : null,
                    ]);
                }
            }
        }
    }
}
