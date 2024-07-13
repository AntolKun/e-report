<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassAssignmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('class_assignments')->insert([
            [
                'class_id' => 1, // Kelas 12 IPA 1
                'student_id' => 1 // Siswa Pertama
            ],
            [
                'class_id' => 1, // Kelas 12 IPA 1
                'student_id' => 2 // Siswa Kedua
            ],
            [
                'class_id' => 2, // Kelas 12 IPA 2
                'student_id' => 3 // Siswa Ketiga
            ],
            [
                'class_id' => 3, // Kelas 12 IPS 1
                'student_id' => 4 // Siswa Keempat
            ]
        ]);
    }
}
