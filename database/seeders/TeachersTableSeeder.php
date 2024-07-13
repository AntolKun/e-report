<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teachers')->insert([
            [
                'user_id' => 2,
                'teacher_name' => 'Guru Pertama',
                'nip' => '123456789'
            ]
        ]);
    }
}
