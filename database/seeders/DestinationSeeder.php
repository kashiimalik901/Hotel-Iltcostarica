<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'San José',
                'description' => 'The capital and largest city of Costa Rica, known for its cultural attractions and central location.',
                'country' => 'Costa Rica',
                'region' => 'Central Valley',
                'is_featured' => true,
                'image_url' => 'destinations/san-jose.jpg',
            ],
            [
                'name' => 'Guanacaste',
                'description' => 'Famous for its beautiful beaches, dry tropical forests, and luxury resorts.',
                'country' => 'Costa Rica',
                'region' => 'North Pacific',
                'is_featured' => true,
                'image_url' => 'destinations/guanacaste.jpg',
            ],
            [
                'name' => 'Puntarenas',
                'description' => 'Coastal province with beautiful beaches and access to the Pacific Ocean.',
                'country' => 'Costa Rica',
                'region' => 'Central Pacific',
                'is_featured' => true,
                'image_url' => 'destinations/puntarenas.jpg',
            ],
            [
                'name' => 'Limón',
                'description' => 'Caribbean coast with Afro-Caribbean culture and beautiful beaches.',
                'country' => 'Costa Rica',
                'region' => 'Caribbean',
                'is_featured' => false,
                'image_url' => 'destinations/limon.jpg',
            ],
            [
                'name' => 'Alajuela',
                'description' => 'Known for its coffee plantations and proximity to Juan Santamaría International Airport.',
                'country' => 'Costa Rica',
                'region' => 'Central Valley',
                'is_featured' => false,
                'image_url' => 'destinations/alajuela.jpg',
            ],
        ];

        foreach ($destinations as $destination) {
            \App\Models\Destination::updateOrCreate(
                ['name' => $destination['name']],
                $destination
            );
        }
    }
}
