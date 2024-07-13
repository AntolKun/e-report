<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicYearsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('academic_years')->insert([
            ['year_name' => '2023/2024'],
            ['year_name' => '2024/2025']
        ]);
    }
}
