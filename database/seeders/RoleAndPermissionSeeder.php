<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        //Create Permissions
        $adminPermissions = [
            'add books', 'delete books', 'edit books', 'view books', 'buy books', 'put to cart'
        ];

        $userPermissions = [
            'view books', 'buy books', 'put to cart'
        ];

        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach ($userPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        //Assign Permissions to Roles
        $admin->givePermissionTo($adminPermissions);
        $user->givePermissionTo($userPermissions);
    }
}
