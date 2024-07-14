<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            ['username' => 'admin1', 'password' => Hash::make('password'), 'role' => 'admin'],
            ['username' => 'guru1', 'password' => Hash::make('password'), 'role' => 'guru'],
            ['username' => 'siswa1', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa2', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa3', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa4', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa5', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa6', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa7', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa8', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa9', 'password' => Hash::make('password'), 'role' => 'siswa'],
            ['username' => 'siswa10', 'password' => Hash::make('password'), 'role' => 'siswa'],
            // kalo kurang tambahin aja sendiri, copy paste mulai dari kurung array yang ini => []
        ]);
    }
}
