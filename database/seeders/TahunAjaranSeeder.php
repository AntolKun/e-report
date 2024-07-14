<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tahun_ajaran')->insert([
            ['tahun_ajaran' => '2023/2024'],
            ['tahun_ajaran' => '2024/2025'],
            // kalo kurang tambahin aja sendiri, copy paste mulai dari kurung array yang ini => []
        ]);
    }
}
