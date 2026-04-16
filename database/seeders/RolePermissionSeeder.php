<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view leads',
            'manage leads',
            'view clients',
            'manage clients',
            'view shipments',
            'manage shipments',
            'access admin panel',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        $admin = Role::findOrCreate('admin');
        $manager = Role::findOrCreate('manager');
        $client = Role::findOrCreate('client');

        $admin->syncPermissions($permissions);
        $manager->syncPermissions([
            'view leads',
            'manage leads',
            'view clients',
            'manage clients',
            'view shipments',
            'manage shipments',
            'access admin panel',
        ]);
        $client->syncPermissions([
            'view shipments',
        ]);
    }
}
