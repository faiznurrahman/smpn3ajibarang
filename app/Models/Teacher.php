<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'nama', 'foto', 'jenis', 'jabatan', 'mapel', 'is_active', 'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    protected static function booted(): void
    {
        static::created(function (self $teacher) {
            Member::create([
                'teacher_id' => $teacher->id,
                'nama'       => $teacher->nama,
                'jenis'      => 'guru',
                'is_active'  => $teacher->is_active,
                'status'     => $teacher->is_active ? 'aktif' : 'keluar',
            ]);
        });

        static::updated(function (self $teacher) {
            $teacher->member?->update([
                'nama'      => $teacher->nama,
                'is_active' => $teacher->is_active,
                'status'    => $teacher->is_active ? 'aktif' : 'keluar',
            ]);
        });

        static::deleted(function (self $teacher) {
            $teacher->member?->update([
                'is_active' => false,
                'status'    => 'keluar',
            ]);
        });
    }
}
