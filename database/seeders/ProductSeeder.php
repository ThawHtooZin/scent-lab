<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Arctic Linen',
                'slug' => 'arctic-linen',
                'subtitle' => 'Indoor refresh',
                'description' => 'A crisp, clean scent built for professional focus in air-conditioned interiors.',
                'price' => 125.00,
                'size' => '100ML',
                'image' => '1777992157-Arctic Linen.png',
                'top_note' => 'White Musk',
                'heart_note' => 'Linen Flower',
                'base_note' => 'Soft Cedar',
                'is_featured' => true,
                'display_order' => 1,
                'category_slug' => 'intra-aero',
            ],
            [
                'name' => 'Velvet Study',
                'slug' => 'velvet-study',
                'subtitle' => 'Library calm',
                'description' => 'Warm sandalwood and tea for a calm workspace atmosphere.',
                'price' => 130.00,
                'size' => '100ML',
                'image' => '1777814662-product1.jpg',
                'top_note' => 'Bergamot',
                'heart_note' => 'Black Tea',
                'base_note' => 'Sandalwood',
                'is_featured' => true,
                'display_order' => 2,
                'category_slug' => 'intra-aero',
            ],
            [
                'name' => 'Silk Morning',
                'slug' => 'silk-morning',
                'subtitle' => 'Soft bloom',
                'description' => 'Light floral freshness for a gentle professional start.',
                'price' => 110.00,
                'size' => '100ML',
                'image' => '',
                'top_note' => 'Green Pear',
                'heart_note' => 'White Iris',
                'base_note' => 'Musk',
                'is_featured' => false,
                'display_order' => 3,
                'category_slug' => 'intra-aero',
            ],
            [
                'name' => 'Solar Citrus',
                'slug' => 'solar-citrus',
                'subtitle' => 'Outdoor energy',
                'description' => 'High-energy zest that stays fresh under the sun.',
                'price' => 120.00,
                'size' => '100ML',
                'image' => '1777815915-product2.jpg',
                'top_note' => 'Grapefruit',
                'heart_note' => 'Neroli',
                'base_note' => 'Vetiver',
                'is_featured' => true,
                'display_order' => 4,
                'category_slug' => 'kinetic-open',
            ],
            [
                'name' => 'Equator Moss',
                'slug' => 'equator-moss',
                'subtitle' => 'Humidity cut',
                'description' => 'Earthy and green, designed to remain crisp in humid heat.',
                'price' => 135.00,
                'size' => '100ML',
                'image' => '',
                'top_note' => 'Moss',
                'heart_note' => 'Sage',
                'base_note' => 'Patchouli',
                'is_featured' => false,
                'display_order' => 5,
                'category_slug' => 'kinetic-open',
            ],
            [
                'name' => 'Azure Tide',
                'slug' => 'azure-tide',
                'subtitle' => 'Marine cool',
                'description' => 'A cooling marine scent with strong outdoor projection.',
                'price' => 140.00,
                'size' => '100ML',
                'image' => '',
                'top_note' => 'Sea Salt',
                'heart_note' => 'Marine Accord',
                'base_note' => 'White Woods',
                'is_featured' => false,
                'display_order' => 6,
                'category_slug' => 'kinetic-open',
            ],
            [
                'name' => 'Metro Mint',
                'slug' => 'metro-mint',
                'subtitle' => 'Crowded calm',
                'description' => 'Refreshing and airy, perfect for public transport and busy commutes.',
                'price' => 115.00,
                'size' => '100ML',
                'image' => '',
                'top_note' => 'Peppermint',
                'heart_note' => 'Eucalyptus',
                'base_note' => 'Musk',
                'is_featured' => false,
                'display_order' => 7,
                'category_slug' => 'density-balanced',
            ],
            [
                'name' => 'Social Amber',
                'slug' => 'social-amber',
                'subtitle' => 'Event ready',
                'description' => 'A sophisticated, skin-close amber for polished social settings.',
                'price' => 145.00,
                'size' => '100ML',
                'image' => '',
                'top_note' => 'Pink Pepper',
                'heart_note' => 'Amber',
                'base_note' => 'Vanilla',
                'is_featured' => false,
                'display_order' => 8,
                'category_slug' => 'density-balanced',
            ],
            [
                'name' => 'Civic Bloom',
                'slug' => 'civic-bloom',
                'subtitle' => 'Urban balance',
                'description' => 'Polite floral balance for crowded city environments.',
                'price' => 125.00,
                'size' => '100ML',
                'image' => '',
                'top_note' => 'Orange Blossom',
                'heart_note' => 'Peony',
                'base_note' => 'Musk',
                'is_featured' => false,
                'display_order' => 9,
                'category_slug' => 'density-balanced',
            ],
            [
                'name' => 'The Lab Signature',
                'slug' => 'the-lab-signature',
                'subtitle' => 'Hybrid adaptor',
                'description' => 'A balanced formula that adapts from soft indoor diffusion to outdoor longevity.',
                'price' => 150.00,
                'size' => '100ML',
                'image' => '1777815920-product3.jpg',
                'top_note' => 'Grapefruit',
                'heart_note' => 'Jasmine',
                'base_note' => 'Sandalwood',
                'is_featured' => true,
                'display_order' => 10,
                'category_slug' => 'hybrid',
            ],
        ];

        foreach ($products as $productAttributes) {
            $category = Category::where('slug', $productAttributes['category_slug'])->first();
            $product = array_merge($productAttributes, [
                'category_id' => optional($category)->id,
            ]);

            unset($product['category_slug']);
            Product::updateOrCreate(['slug' => $product['slug']], $product);
        }
    }
}
