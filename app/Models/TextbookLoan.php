<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextbookLoan extends Model
{
    protected $fillable = [
        'tahun_ajaran', 'untuk_tingkat', 'tgl_distribusi', 'tgl_kembali', 'status', 'petugas_id',
    ];

    protected $casts = [
        'tgl_distribusi' => 'date',
        'tgl_kembali'    => 'date',
        'untuk_tingkat'  => 'integer',
    ];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function loanItems()
    {
        return $this->hasMany(TextbookLoanItem::class, 'loan_id');
    }

    public function distributeToMembers(array $textbookIds): array
    {
        $members = Member::aktif()->siswa()
            ->tingkat($this->tahun_ajaran, $this->untuk_tingkat)
            ->orderBy('kode_anggota', 'asc')
            ->get();

        $assigned         = 0;
        $skipped          = 0;
        $assignedMemberIds = collect();

        foreach ($textbookIds as $textbookId) {
            $availableItems = TextbookItem::where('textbook_id', $textbookId)
                ->where('is_available', true)
                ->get()
                ->values();

            $itemIndex = 0;

            foreach ($members as $member) {
                $alreadyAssigned = TextbookLoanItem::where('loan_id', $this->id)
                    ->where('member_id', $member->id)
                    ->whereHas('textbookItem', fn ($q) => $q->where('textbook_id', $textbookId))
                    ->exists();

                if ($alreadyAssigned) {
                    $skipped++;
                    continue;
                }

                $item = $availableItems->get($itemIndex);
                if (! $item) {
                    $skipped++;
                    continue;
                }

                $kondisiPinjam = in_array($item->kondisi, ['baik', 'rusak_ringan', 'rusak_berat'])
                    ? $item->kondisi
                    : 'baik';

                TextbookLoanItem::create([
                    'loan_id'          => $this->id,
                    'member_id'        => $member->id,
                    'textbook_item_id' => $item->id,
                    'kondisi_pinjam'   => $kondisiPinjam,
                ]);

                $item->update(['is_available' => false]);
                $assigned++;
                $assignedMemberIds->push($member->id);
                $itemIndex++;
            }
        }

        return [
            'assigned' => $assigned,
            'skipped'  => $skipped,
            'siswa'    => $assignedMemberIds->unique()->count(),
        ];
    }
}
