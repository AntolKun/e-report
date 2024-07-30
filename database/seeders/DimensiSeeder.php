<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dimensi')->insert([
            ['dimensi' => 'Beriman, Bertakwa kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia'],
            ['dimensi' => 'Mandiri'],
            ['dimensi' => 'Bergotong Royong'],
            ['dimensi' => 'Berkebhinekaan global'],
            ['dimensi' => 'Bernalar Kritis'],
            ['dimensi' => 'Kreatif'],
            // Tambahkan dimensi lainnya jika perlu
        ]);
    }
}
