<?php

namespace Database\Seeders;

use App\Models\BillingFrequency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillingFrequencySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $frequencies = [
      'Hourly' => '1 Hour',
      'Daily' => '1 Day',
      'Weekly' => '1 Week',
      'Monthly' => '1 Month',
      '2 Months' => '2 Months',
      '3 Months' => '3 Months',
      '4 Months' => '4 Months',
      '5 Months' => '5 Months',
      '6 Months' => '6 Months',
      '7 Months' => '7 Months',
      '8 Months' => '8 Months',
      '9 Months' => '9 Months',
      '10 Months' => '10 Months',
      '11 Months' => '11 Months',
      '12 Months' => '12 Months',
      '2 Years' => '2 Years',
      '3 Years' => '3 Years',
      '4 Years' => '4 Years',
      '5 Years' => '5 Years',
    ];

    collect($frequencies)->each(function($frequency, $value) {
      BillingFrequency::create([
        'name' => $value,
        'description' => $frequency
      ]);
    });
  }
}
