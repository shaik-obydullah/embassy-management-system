<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage-citizens',
            'manage-services',
            'manage-appointments',
            'manage-passports',
            'manage-consulars',
            'manage-content',
            'manage-users',
            'manage-reports',
            'view-dashboard',
            'book-appointment',
            'manage-profile',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superadmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $superadmin->syncPermissions($permissions);

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminPermissions = array_diff($permissions, ['manage-users', 'manage-reports']);
        $admin->syncPermissions($adminPermissions);

        $client = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);
        $client->syncPermissions(['book-appointment', 'manage-profile']);
    }
}
