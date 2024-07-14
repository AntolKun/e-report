<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gurus')->insert([
            'user_id' => 2,
            'nama' => 'Guru Satu',
            'jenis_kelamin' => 'Laki-Laki',
            'tanggal_lahir' => '1980-01-01',
            'agama' => 'Islam',
            'email' => 'guru1@example.com',
            'nomor_telepon' => '081234567890',
            'foto' => null,
        ]);
    }
}
