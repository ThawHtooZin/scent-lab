<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Terra Incognita',
                'slug' => 'terra-incognita',
                'subtitle' => 'EAU DE PARFUM',
                'description' => 'A sensory map of uncharted landscapes and warm woods.',
                'price' => 215.00,
                'size' => '100ML',
                'image_key' => 'story_1',
                'top_note' => 'Bergamot & Pink Pepper',
                'heart_note' => 'Smoked Vetiver & Orris',
                'base_note' => 'Amber Resin & Cedar',
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'Citrus Noir',
                'slug' => 'citrus-noir',
                'subtitle' => 'NIGHT RITUAL',
                'description' => 'Midnight citrus with smoked peppercorn and dark neroli.',
                'price' => 95.00,
                'size' => '250ML',
                'image_key' => 'story_2',
                'top_note' => 'Bergamot',
                'heart_note' => 'Peppercorn',
                'base_note' => 'Dark Neroli',
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Velvet Bloom',
                'slug' => 'velvet-bloom',
                'subtitle' => 'VELVET INFUSION',
                'description' => 'A velvety bouquet of night jasmine and rose blossom.',
                'price' => 165.00,
                'size' => '100ML',
                'image_key' => 'story_3',
                'top_note' => 'Pear',
                'heart_note' => 'Jasmine',
                'base_note' => 'Musk',
                'is_featured' => false,
                'display_order' => 3,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }
    }
}
