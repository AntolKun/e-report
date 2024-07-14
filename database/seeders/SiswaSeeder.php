<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswas')->insert([
            [
                'user_id' => 3,
                'nama' => 'Siswa Satu',
                'nisn' => '1234567890',
                'jenis_kelamin' => 'Laki-Laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2006-01-01',
                'agama' => 'Islam',
                'email' => 'siswa1@example.com',
                'nomor_telepon' => '081234567891',
                'foto' => null,
            ],
            [
                'user_id' => 4,
                'nama' => 'Siswa Dua',
                'nisn' => '1234567891',
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2006-02-01',
                'agama' => 'Kristen',
                'email' => 'siswa2@example.com',
                'nomor_telepon' => '081234567892',
                'foto' => null,
            ],
            // kalo kurang tambahin aja sendiri, copy paste mulai dari kurung array yang ini => []
        ]);
    }
}
