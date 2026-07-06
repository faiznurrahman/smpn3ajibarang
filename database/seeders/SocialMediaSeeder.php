<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SocialMedia::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $items = [
            ['nama' => 'Facebook',  'url' => 'https://facebook.com/smpn3ajibarang',  'icon' => 'facebook',  'is_active' => true,  'order' => 1],
            ['nama' => 'Instagram', 'url' => 'https://instagram.com/smpn3ajibarang', 'icon' => 'instagram', 'is_active' => true,  'order' => 2],
            ['nama' => 'YouTube',   'url' => 'https://youtube.com/@smpn3ajibarang',  'icon' => 'youtube',   'is_active' => true,  'order' => 3],
            ['nama' => 'Twitter/X', 'url' => 'https://twitter.com/smpn3ajibarang',   'icon' => 'twitter',   'is_active' => false, 'order' => 4],
        ];

        foreach ($items as $data) {
            SocialMedia::create($data);
        }
    }
}
