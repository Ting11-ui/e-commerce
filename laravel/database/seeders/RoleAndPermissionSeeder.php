<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            'users.manage',
            'products.create',
            'products.update',
            'products.delete',
            'category.create',
            'category.update',
            'category.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Roles
        $adminRole = Role::create(['name' => 'Admin']);
        $managerRole = Role::create(['name' => 'Manager']);
        $staffRole = Role::create(['name' => 'Staff']);

        // Assign Permissions to Admin (all permissions)
        $adminRole->permissions()->attach(Permission::all());

        // Assign Permissions to Manager
        $managerRole->permissions()->attach(
            Permission::whereIn('name', [
                'products.create',
                'products.update',
                'products.delete',
                'category.create',
                'category.update',
                'category.delete',
            ])->get()
        );

        // Assign Permissions to Staff
        $staffRole->permissions()->attach(
            Permission::whereIn('name', [
                'products.create',
            ])->get()
        );
    }
}
