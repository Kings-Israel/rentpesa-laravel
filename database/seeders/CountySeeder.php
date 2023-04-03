<?php

namespace Database\Seeders;

use App\Models\County;
use App\Models\Subcounty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $counties = file_get_contents('./database/seeders/counties.json');

      foreach (json_decode($counties) as $key => $county) {
        $saved_county = County::create(['name' => $county->name]);
        foreach ($county->sub_counties as $key => $sub_county) {
          Subcounty::create(['county_id' => $saved_county->id, 'name' => Str::ucfirst($sub_county)]);
        }
      }
    }
}
