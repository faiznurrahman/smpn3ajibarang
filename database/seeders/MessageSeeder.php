<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $messages = [
            [
                'nama'          => 'Budi Santoso',
                'nomor_telepon' => '08123456789',
                'email'         => 'budi@gmail.com',
                'subjek'        => 'Informasi Sekolah',
                'isi_pesan'     => 'Selamat siang, saya ingin menanyakan informasi mengenai kegiatan ekstrakurikuler yang tersedia di sekolah ini. Terima kasih.',
                'is_read'       => false,
            ],
            [
                'nama'          => 'Siti Rahayu',
                'nomor_telepon' => '08234567890',
                'email'         => 'siti@gmail.com',
                'subjek'        => 'Prestasi Siswa',
                'isi_pesan'     => 'Halo, saya orang tua siswa kelas 8. Ingin menanyakan jadwal penerimaan rapor semester ini. Mohon informasinya.',
                'is_read'       => false,
            ],
            [
                'nama'          => 'Ahmad Fauzi',
                'nomor_telepon' => '08345678901',
                'email'         => 'ahmad@gmail.com',
                'subjek'        => 'Kerjasama',
                'isi_pesan'     => 'Selamat pagi, kami dari lembaga bimbingan belajar ingin menjalin kerjasama dengan pihak sekolah. Boleh kami hubungi siapa?',
                'is_read'       => true,
                'read_at'       => now(),
            ],
        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }
}