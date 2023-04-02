<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\Concerns\Has;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
          'name' => 'Admin',
          'email' => 'admin@rentpesa.com',
          'phone_number' => NULL
        ]);

        $admin->assignRole('admin');

        $landlord = User::factory()->create([
          'name' => 'Landlord',
          'email' => 'landlord@rentpesa.com',
        ]);

        $landlord->assignRole('landlord');

        $tenant = User::factory()->create([
          'name' => 'Agent',
          'email' => 'tenant@rentpesa.com',
        ]);

        $tenant->assignRole('tenant');

        $agent = User::factory()->create([
          'name' => 'Agent',
          'email' => 'agent@rentpesa.com',
        ]);

        $agent->assignRole('agent');
    }
}
