<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(CountySeeder::class);
    $this->call(RolesAndPermissionsSeeder::class);
    $this->call(PropertyTypeSeeder::class);
    $this->call(BillingFrequencySeeder::class);
    $this->call(UnitTypeSeeder::class);
    $this->call(UsersSeeder::class);
  }
}
