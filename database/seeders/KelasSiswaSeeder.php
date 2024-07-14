<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelas_siswa')->insert([
            ['kelas_id' => 1, 'siswa_id' => 1],
            ['kelas_id' => 1, 'siswa_id' => 2],
            // kalo kurang tambahin aja sendiri, copy paste mulai dari kurung array yang ini => []
        ]);
    }
}
