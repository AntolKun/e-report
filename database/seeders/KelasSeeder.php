<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'nama_kelas' => '12 IPA 1',
                'tahun_id' => 1,
                'guru_id' => 1,
            ],
            [
                'nama_kelas' => '12 IPS 1',
                'tahun_id' => 1,
                'guru_id' => 1,
            ],
            // kalo kurang tambahin aja sendiri, copy paste mulai dari kurung array yang ini => []
        ]);
    }
}
