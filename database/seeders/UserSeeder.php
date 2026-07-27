<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@embassy.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );
        $superadmin->assignRole('superadmin');

        $admin = User::firstOrCreate(
            ['email' => 'admin@embassy.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        $client = User::firstOrCreate(
            ['email' => 'client@embassy.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
            ]
        );
        $client->assignRole('client');

        $jane = User::firstOrCreate(
            ['email' => 'jane@embassy.com'],
            [
                'name' => 'Jane Smith',
                'password' => Hash::make('password'),
            ]
        );
        $jane->assignRole('client');
    }
}
