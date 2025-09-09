<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Luxury Resort',
                'description' => 'High-end resorts with premium amenities and services.',
            ],
            [
                'name' => 'Boutique Hotel',
                'description' => 'Small, intimate hotels with unique character and personalized service.',
            ],
            [
                'name' => 'Eco Lodge',
                'description' => 'Environmentally conscious accommodations in natural settings.',
            ],
            [
                'name' => 'Beach Hotel',
                'description' => 'Hotels located directly on or near the beach.',
            ],
            [
                'name' => 'Mountain Lodge',
                'description' => 'Accommodations in mountainous or forested areas.',
            ],
            [
                'name' => 'City Hotel',
                'description' => 'Hotels located in urban areas with easy access to city attractions.',
            ],
            [
                'name' => 'All-Inclusive Resort',
                'description' => 'Resorts where meals, drinks, and activities are included in the price.',
            ],
            [
                'name' => 'Bed & Breakfast',
                'description' => 'Small accommodations offering breakfast and personal service.',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\HotelCategory::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
