<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Apartment/Flat', 'Bungalow', 'Commercial Property', 'Farm', 'House', 'Industrial Property', 'Masionette', 'Parking Space', 'Office', 'Shopping Center', 'Storage', 'Townhouse', 'Vacant Plot/Land'];

        collect($types)->each(fn ($type) => PropertyType::create(['name' => $type]));
    }
}
