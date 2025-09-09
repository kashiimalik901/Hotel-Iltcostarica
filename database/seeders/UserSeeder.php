<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the Super Admin role
        $superAdminRole = \App\Models\Role::where('name', 'Super Admin')->first();
        $adminRole = \App\Models\Role::where('name', 'Admin')->first();

        if ($superAdminRole) {
            \App\Models\User::updateOrCreate(
                ['email' => 'admin@hotelcostarica.com'],
                [
                    'name' => 'System Administrator',
                    'email' => 'admin@hotelcostarica.com',
                    'password' => bcrypt('admin123'),
                    'role_id' => $superAdminRole->id,
                    'status' => 'active',
                ]
            );
        }

        if ($adminRole) {
            \App\Models\User::updateOrCreate(
                ['email' => 'manager@hotelcostarica.com'],
                [
                    'name' => 'Hotel Manager',
                    'email' => 'manager@hotelcostarica.com',
                    'password' => bcrypt('manager123'),
                    'role_id' => $adminRole->id,
                    'status' => 'active',
                ]
            );
        }
    }
}
