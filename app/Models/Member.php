<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'kode_anggota', 'nama', 'kelas', 'jenis', 'no_hp', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function ($member) {
            if (empty($member->kode_anggota)) {
                $next   = (static::max('id') ?? 0) + 1;
                $prefix = $member->jenis === 'guru' ? 'GRU' : 'ANK';
                $member->kode_anggota = $prefix . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoans()
    {
        return $this->hasMany(Loan::class)->where('status', 'dipinjam');
    }
}
