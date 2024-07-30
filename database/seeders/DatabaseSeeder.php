<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // isinya semua file seeder yang perlu di seed, jadi gausah satu satu
    $this->call([
      UserSeeder::class,
      AdminSeeder::class,
      GuruSeeder::class,
      SiswaSeeder::class,
      TahunAjaranSeeder::class,
      KelasSeeder::class,
      KelasSiswaSeeder::class,
      DimensiSeeder::class,
    ]);
  }
}
