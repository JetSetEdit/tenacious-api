<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Tenacious Tapes',
            'overview' => 'Tenacious Tapes is a leading manufacturer of high-quality gaffer tape and cloth tape solutions. Our products are trusted by professionals in film, television, theater, photography, and industrial applications worldwide. We specialize in creating durable, reliable tapes that perform under the most demanding conditions.',
            'company_description' => 'Founded with a commitment to quality and innovation, Tenacious Tapes has been at the forefront of adhesive tape technology for over two decades. Our state-of-the-art manufacturing facilities and rigorous quality control processes ensure that every roll of tape meets the highest industry standards. We pride ourselves on providing exceptional customer service and technical support to help our clients find the perfect tape solution for their specific needs.',
            'website' => 'https://tenacioustapes.com',
            'email' => 'info@tenacioustapes.com',
            'phone' => '+1-800-TAPE-123',
            'address' => '123 Industrial Way, Manufacturing District, CA 90210',
            'logo_url' => 'https://tenacioustapes.com/images/logo.png',
            'social_media' => [
                'facebook' => 'https://facebook.com/tenacioustapes',
                'twitter' => 'https://twitter.com/tenacioustapes',
                'instagram' => 'https://instagram.com/tenacioustapes',
                'linkedin' => 'https://linkedin.com/company/tenacioustapes'
            ],
            'is_active' => true,
        ]);

        $this->command->info('✅ Tenacious Tapes brand data seeded successfully!');
    }
}
