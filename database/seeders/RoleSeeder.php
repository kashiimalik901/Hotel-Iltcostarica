<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'description' => 'Full system access and control',
                'permissions' => ['*'],
            ],
            [
                'name' => 'Admin',
                'description' => 'Hotel management and booking administration',
                'permissions' => ['hotels.*', 'bookings.*', 'customers.*', 'reports.*'],
            ],
            [
                'name' => 'Manager',
                'description' => 'Hotel-specific management and operations',
                'permissions' => ['hotels.view', 'bookings.*', 'customers.*', 'reports.view'],
            ],
            [
                'name' => 'Staff',
                'description' => 'Basic booking and customer management',
                'permissions' => ['bookings.view', 'bookings.create', 'customers.view', 'customers.create'],
            ],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}
