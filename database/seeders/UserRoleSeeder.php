<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Administrator',
                'email'    => 'admin@smpn3ajibarang.sch.id',
                'password' => 'password',
                'role'     => 'admin',
            ],
            [
                'name'     => 'Petugas Perpustakaan',
                'email'    => 'petugas@smpn3ajibarang.sch.id',
                'password' => 'password',
                'role'     => 'petugas_perpustakaan',
            ],
            [
                'name'     => 'Kepala Sekolah',
                'email'    => 'kepala@smpn3ajibarang.sch.id',
                'password' => 'password',
                'role'     => 'kepala_sekolah',
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(['email' => $data['email']], $data);
        }
    }
}
