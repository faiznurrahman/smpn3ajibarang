<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'teacher_id', 'kode_anggota', 'nama', 'kelas', 'jenis', 'no_hp',
        'is_active', 'tahun_masuk', 'status',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'tahun_masuk' => 'integer',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoans()
    {
        return $this->hasMany(Loan::class)->where('status', 'dipinjam');
    }

    public function textbookDistributionItems()
    {
        return $this->hasMany(TextbookDistributionItem::class);
    }

    public function getTingkatAttribute(): ?int
    {
        if ($this->jenis !== 'siswa' || ! $this->tahun_masuk) {
            return null;
        }
        $tahunBerjalan = now()->month >= 7 ? now()->year : now()->year - 1;
        $tingkat = $tahunBerjalan - $this->tahun_masuk + 7;
        return ($tingkat >= 7 && $tingkat <= 9) ? $tingkat : null;
    }

    public function getAngkatanLabelAttribute(): ?string
    {
        return $this->tahun_masuk ? 'Angkatan ' . $this->tahun_masuk : null;
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeSiswa($query)
    {
        return $query->where('jenis', 'siswa');
    }

    public function scopeTingkat($query, $tahunAjaran, $tingkat)
    {
        $tahunMulai = (int) explode('/', $tahunAjaran)[0];
        $tahunMasuk = $tahunMulai - $tingkat + 7;
        return $query->where('tahun_masuk', $tahunMasuk);
    }
}
