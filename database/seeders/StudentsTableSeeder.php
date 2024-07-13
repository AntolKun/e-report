<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            [
                'user_id' => 3,
                'student_name' => 'Siswa Pertama',
                'nis' => '987654321'
            ],
            [
                'user_id' => 4,
                'student_name' => 'Siswa Kedua',
                'nis' => '987654322'
            ],
            [
                'user_id' => 5,
                'student_name' => 'Siswa Ketiga',
                'nis' => '987654323'
            ],
            [
                'user_id' => 6,
                'student_name' => 'Siswa Keempat',
                'nis' => '987654324'
            ]
        ]);
    }
}
