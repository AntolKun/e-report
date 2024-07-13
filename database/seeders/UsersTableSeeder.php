<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin1',
                'password' => Hash::make('password1'),
                'role_id' => 1
            ],
            [
                'username' => 'guru1',
                'password' => Hash::make('password2'),
                'role_id' => 2
            ],
            [
                'username' => 'siswa1',
                'password' => Hash::make('password3'),
                'role_id' => 3
            ],
            [
                'username' => 'siswa2',
                'password' => Hash::make('password4'),
                'role_id' => 3
            ],
            [
                'username' => 'siswa3',
                'password' => Hash::make('password5'),
                'role_id' => 3
            ],
            [
                'username' => 'siswa4',
                'password' => Hash::make('password6'),
                'role_id' => 3
            ]
        ]);
    }
}