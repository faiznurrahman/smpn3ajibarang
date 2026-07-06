<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    public function run(): void
    {
        ContactInfo::updateOrCreate(['id' => 1], [
            'alamat'        => 'Jl. Raya Ajibarang Timur No. 53, Kec. Ajibarang, Kab. Banyumas, Jawa Tengah 53163',
            'nomor_telepon' => '(0281) 572345',
            'email'         => 'smpn3ajibarang@gmail.com',
            'website'       => 'https://smpn3ajibarang.sch.id',
            'embed_maps'    => '<iframe src="https://maps.google.com/maps?q=SMP+Negeri+3+Ajibarang,+Jl.+Raya+Ajibarang+Timur+No.+53&output=embed" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
        ]);
    }
}
