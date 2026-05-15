<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'book_id', 'member_id', 'tgl_pinjam', 'tgl_batas_kembali',
        'tgl_kembali', 'status', 'petugas_id',
    ];

    protected $casts = [
        'tgl_pinjam'        => 'date',
        'tgl_batas_kembali' => 'date',
        'tgl_kembali'       => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }

    public function isLate(): bool
    {
        $checkDate = $this->tgl_kembali ?? Carbon::today();
        return $checkDate->gt($this->tgl_batas_kembali);
    }

    public function jumlahHariTerlambat(): int
    {
        if (! $this->isLate()) {
            return 0;
        }
        $checkDate = $this->tgl_kembali ?? Carbon::today();
        return (int) $this->tgl_batas_kembali->diffInDays($checkDate);
    }
}
