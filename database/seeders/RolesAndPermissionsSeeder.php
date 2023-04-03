<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'landlord', 'tenant', 'agent'];

        collect($roles)->each(fn ($role) => Role::create(['name' => $role]));

        $permissions = [
          // Property Permissions
          'create property',
          'view property',
          'edit property',
          'delete property',

          // unit permissions
          'create unit',
          'view unit',
          'edit unit',
          'delete unit',
        ];

        collect($permissions)->each(fn ($permission) => Permission::create(['name' => $permission]));

        Role::findByName('landlord')->givePermissionTo('create property');
        Role::findByName('landlord')->givePermissionTo('view property');
        Role::findByName('landlord')->givePermissionTo('edit property');
        Role::findByName('landlord')->givePermissionTo('delete property');

        Role::findByName('tenant')->givePermissionTo('view property');

        Role::findByName('landlord')->givePermissionTo('create unit');
        Role::findByName('landlord')->givePermissionTo('view unit');
        Role::findByName('landlord')->givePermissionTo('edit unit');
        Role::findByName('landlord')->givePermissionTo('delete unit');

        Role::findByName('agent')->givePermissionTo('create unit');
        Role::findByName('agent')->givePermissionTo('view unit');
        Role::findByName('agent')->givePermissionTo('edit unit');
        Role::findByName('agent')->givePermissionTo('delete unit');

        Role::findByName('tenant')->givePermissionTo('view unit');
    }
}
