<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Kiosk Daftar Hadir — Pembatasan Akses
    |--------------------------------------------------------------------------
    |
    | Pengaturan pembatasan akses untuk halaman /perpustakaan/hadir.
    | Katalog buku (/perpustakaan/katalog) TIDAK dibatasi oleh pengaturan ini.
    |
    */

    'kiosk' => [

        // Daftar CIDR jaringan sekolah yang diizinkan, dipisahkan koma.
        // Kosongkan untuk menonaktifkan pembatasan IP (semua jaringan diizinkan).
        // Contoh: LIBRARY_KIOSK_ALLOWED_CIDR=192.168.1.0/24,10.0.0.0/8
        'allowed_cidrs' => array_values(array_filter(array_map(
            'trim',
            explode(',', (string) env('LIBRARY_KIOSK_ALLOWED_CIDR', ''))
        ))),

        // Hari operasional, format ISO weekday (1 = Senin ... 7 = Minggu).
        'operating_days' => array_values(array_filter(array_map(
            'intval',
            explode(',', (string) env('LIBRARY_KIOSK_OPERATING_DAYS', '1,2,3,4,5'))
        ))),

        // Jam operasional (format H:i, mengikuti timezone aplikasi).
        'operating_start' => env('LIBRARY_KIOSK_OPERATING_START', '07:00'),
        'operating_end'   => env('LIBRARY_KIOSK_OPERATING_END', '14:00'),
    ],

];
