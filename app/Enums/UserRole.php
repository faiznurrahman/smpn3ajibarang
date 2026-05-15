<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin               = 'admin';
    case PetugasPerpustakaan = 'petugas_perpustakaan';
    case KepalaSekolah       = 'kepala_sekolah';

    public function label(): string
    {
        return match ($this) {
            self::Admin               => 'Admin',
            self::PetugasPerpustakaan => 'Petugas Perpustakaan',
            self::KepalaSekolah       => 'Kepala Sekolah',
        };
    }
}
