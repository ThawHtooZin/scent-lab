<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'The Intra-Aero Collection',
                'slug' => 'intra-aero',
                'description' => 'Indoor / Air-Con collection optimized for soft projection in enclosed spaces.',
                'display_order' => 1,
            ],
            [
                'name' => 'The Kinetic-Open Collection',
                'slug' => 'kinetic-open',
                'description' => 'Outdoor / hot weather collection engineered for stronger diffusion in heat.',
                'display_order' => 2,
            ],
            [
                'name' => 'The Density-Balanced Collection',
                'slug' => 'density-balanced',
                'description' => 'Crowded spaces collection balanced for freshness without overpowering.',
                'display_order' => 3,
            ],
            [
                'name' => 'The Hybrid Collection',
                'slug' => 'hybrid',
                'description' => 'All-day adaptor collection that bridges indoor softness and outdoor longevity.',
                'display_order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
