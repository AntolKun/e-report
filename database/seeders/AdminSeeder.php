<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'user_id' => 1,
            'nama' => 'Admin Satu',
            'email' => 'admin1@example.com',
            'foto' => null,
        ]);
    }
}
