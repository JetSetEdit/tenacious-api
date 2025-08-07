<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Professional Gaffer Tape - Black',
                'sku' => 'TT-GAF-001-BLK',
                'description' => 'High-quality black gaffer tape for professional film, television, and theater applications. Features excellent adhesion and clean removal.',
                'category' => 'Gaffer Tape',
                'type' => 'gaffer',
                'width' => '2 inch',
                'length' => '60 yards',
                'color' => 'Black',
                'price' => 24.99,
                'currency' => 'USD',
                'image_url' => 'https://tenacioustapes.com/images/gaffer-black.jpg',
                'specifications' => [
                    'adhesive_type' => 'Synthetic rubber',
                    'backing_material' => 'Cotton cloth',
                    'thickness' => '0.23mm',
                    'tensile_strength' => '50 lbs/in',
                    'temperature_range' => '-10°F to 200°F'
                ],
                'features' => [
                    'Clean removal',
                    'No residue',
                    'UV resistant',
                    'Weather resistant',
                    'Professional grade'
                ],
                'applications' => 'Film production, television sets, theater, photography, cable management, temporary mounting',
                'is_featured' => true,
                'is_active' => true,
                'stock_quantity' => 500
            ],
            [
                'name' => 'Professional Gaffer Tape - White',
                'sku' => 'TT-GAF-001-WHT',
                'description' => 'Premium white gaffer tape offering superior adhesion and clean removal. Perfect for professional applications where visibility is key.',
                'category' => 'Gaffer Tape',
                'type' => 'gaffer',
                'width' => '2 inch',
                'length' => '60 yards',
                'color' => 'White',
                'price' => 24.99,
                'currency' => 'USD',
                'image_url' => 'https://tenacioustapes.com/images/gaffer-white.jpg',
                'specifications' => [
                    'adhesive_type' => 'Synthetic rubber',
                    'backing_material' => 'Cotton cloth',
                    'thickness' => '0.23mm',
                    'tensile_strength' => '50 lbs/in',
                    'temperature_range' => '-10°F to 200°F'
                ],
                'features' => [
                    'Clean removal',
                    'No residue',
                    'UV resistant',
                    'Weather resistant',
                    'Professional grade',
                    'High visibility'
                ],
                'applications' => 'Film production, television sets, theater, photography, cable management, temporary mounting',
                'is_featured' => false,
                'is_active' => true,
                'stock_quantity' => 450
            ],
            [
                'name' => 'Heavy Duty Cloth Tape - Black',
                'sku' => 'TT-CLT-001-BLK',
                'description' => 'Heavy-duty black cloth tape designed for industrial applications. Provides exceptional strength and durability.',
                'category' => 'Cloth Tape',
                'type' => 'cloth',
                'width' => '2 inch',
                'length' => '60 yards',
                'color' => 'Black',
                'price' => 19.99,
                'currency' => 'USD',
                'image_url' => 'https://tenacioustapes.com/images/cloth-black.jpg',
                'specifications' => [
                    'adhesive_type' => 'Acrylic',
                    'backing_material' => 'Heavy cotton cloth',
                    'thickness' => '0.28mm',
                    'tensile_strength' => '65 lbs/in',
                    'temperature_range' => '-20°F to 250°F'
                ],
                'features' => [
                    'Heavy duty',
                    'High strength',
                    'Weather resistant',
                    'Industrial grade',
                    'Long lasting'
                ],
                'applications' => 'Industrial applications, construction, automotive, electrical work, heavy-duty mounting',
                'is_featured' => false,
                'is_active' => true,
                'stock_quantity' => 300
            ],
            [
                'name' => 'Heavy Duty Cloth Tape - White',
                'sku' => 'TT-CLT-001-WHT',
                'description' => 'Heavy-duty white cloth tape for industrial applications requiring high visibility and strength.',
                'category' => 'Cloth Tape',
                'type' => 'cloth',
                'width' => '2 inch',
                'length' => '60 yards',
                'color' => 'White',
                'price' => 19.99,
                'currency' => 'USD',
                'image_url' => 'https://tenacioustapes.com/images/cloth-white.jpg',
                'specifications' => [
                    'adhesive_type' => 'Acrylic',
                    'backing_material' => 'Heavy cotton cloth',
                    'thickness' => '0.28mm',
                    'tensile_strength' => '65 lbs/in',
                    'temperature_range' => '-20°F to 250°F'
                ],
                'features' => [
                    'Heavy duty',
                    'High strength',
                    'Weather resistant',
                    'Industrial grade',
                    'Long lasting',
                    'High visibility'
                ],
                'applications' => 'Industrial applications, construction, automotive, electrical work, heavy-duty mounting',
                'is_featured' => false,
                'is_active' => true,
                'stock_quantity' => 275
            ],
            [
                'name' => 'Premium Gaffer Tape - Silver',
                'sku' => 'TT-GAF-002-SLV',
                'description' => 'Premium silver gaffer tape with enhanced reflectivity. Ideal for applications requiring metallic finish and professional appearance.',
                'category' => 'Gaffer Tape',
                'type' => 'gaffer',
                'width' => '2 inch',
                'length' => '60 yards',
                'color' => 'Silver',
                'price' => 29.99,
                'currency' => 'USD',
                'image_url' => 'https://tenacioustapes.com/images/gaffer-silver.jpg',
                'specifications' => [
                    'adhesive_type' => 'Synthetic rubber',
                    'backing_material' => 'Cotton cloth with metallic finish',
                    'thickness' => '0.25mm',
                    'tensile_strength' => '50 lbs/in',
                    'temperature_range' => '-10°F to 200°F'
                ],
                'features' => [
                    'Metallic finish',
                    'Clean removal',
                    'No residue',
                    'UV resistant',
                    'Weather resistant',
                    'Professional grade'
                ],
                'applications' => 'Film production, television sets, theater, photography, decorative applications, cable management',
                'is_featured' => true,
                'is_active' => true,
                'stock_quantity' => 200
            ],
            [
                'name' => 'Economy Cloth Tape - Black',
                'sku' => 'TT-CLT-002-BLK',
                'description' => 'Cost-effective black cloth tape for general purpose applications. Provides reliable performance at an affordable price.',
                'category' => 'Cloth Tape',
                'type' => 'cloth',
                'width' => '2 inch',
                'length' => '60 yards',
                'color' => 'Black',
                'price' => 14.99,
                'currency' => 'USD',
                'image_url' => 'https://tenacioustapes.com/images/cloth-economy-black.jpg',
                'specifications' => [
                    'adhesive_type' => 'Acrylic',
                    'backing_material' => 'Cotton cloth',
                    'thickness' => '0.20mm',
                    'tensile_strength' => '40 lbs/in',
                    'temperature_range' => '-10°F to 180°F'
                ],
                'features' => [
                    'Cost effective',
                    'Reliable performance',
                    'Good adhesion',
                    'General purpose',
                    'Easy to use'
                ],
                'applications' => 'General purpose, home use, light industrial, crafts, temporary repairs',
                'is_featured' => false,
                'is_active' => true,
                'stock_quantity' => 750
            ],
            [
                'name' => 'Economy Cloth Tape - White',
                'sku' => 'TT-CLT-002-WHT',
                'description' => 'Cost-effective white cloth tape for general purpose applications requiring high visibility.',
                'category' => 'Cloth Tape',
                'type' => 'cloth',
                'width' => '2 inch',
                'length' => '60 yards',
                'color' => 'White',
                'price' => 14.99,
                'currency' => 'USD',
                'image_url' => 'https://tenacioustapes.com/images/cloth-economy-white.jpg',
                'specifications' => [
                    'adhesive_type' => 'Acrylic',
                    'backing_material' => 'Cotton cloth',
                    'thickness' => '0.20mm',
                    'tensile_strength' => '40 lbs/in',
                    'temperature_range' => '-10°F to 180°F'
                ],
                'features' => [
                    'Cost effective',
                    'Reliable performance',
                    'Good adhesion',
                    'General purpose',
                    'Easy to use',
                    'High visibility'
                ],
                'applications' => 'General purpose, home use, light industrial, crafts, temporary repairs',
                'is_featured' => false,
                'is_active' => true,
                'stock_quantity' => 700
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('✅ ' . count($products) . ' Tenacious Tapes products seeded successfully!');
    }
}
