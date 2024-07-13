<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('classes')->insert([
            [
                'class_name' => '12 IPA 1',
                'academic_year_id' => 1,
                'teacher_id' => 1
            ],
            [
                'class_name' => '12 IPA 2',
                'academic_year_id' => 1,
                'teacher_id' => 1
            ],
            [
                'class_name' => '12 IPS 1',
                'academic_year_id' => 1,
                'teacher_id' => 1
            ]
        ]);
    }
}
