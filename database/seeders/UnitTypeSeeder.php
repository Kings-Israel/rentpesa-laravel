<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $unit_types = [
      'Single Room',
      'Bedsitter',
      '1 bed Room',
      '1 Bed Room Master Ensuite',
      '2 Bed Room',
      '2 Bed Room Master Ensuite',
      '3 Bed Room',
      '3 Bed Room Master Ensuite',
      '4 Bed Room',
      '4 Bed Room Master Ensuite',
      '5 Bed Room',
      '5 Bed Room Master Ensuite',
      'Office',
      'Stall',
      'Shop',
      'Warehouse',
      'Garage',
      'Others',
      'Double Room',
      'Main House',
      'Store'
    ];

    collect($unit_types)->each(fn ($type) => UnitType::create(['name' => $type]));
  }
}
