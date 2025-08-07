<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Brand;
use App\Models\Product;

class BrandController extends Controller
{
    /**
     * Get brand overview information.
     */
    public function overview(): JsonResponse
    {
        $brand = Brand::where('is_active', true)->first();
        
        if (!$brand) {
            return response()->json([
                'success' => false,
                'error' => 'Brand not found',
                'message' => 'No active brand information available'
            ], 404);
        }

        $overview = [
            'company_name' => $brand->name,
            'parent_company' => 'Schaffer & Co (VIC) Pty Ltd',
            'description' => $brand->overview,
            'market_position' => 'We collaborate with leading global manufacturers to develop tailored solutions that meet the unique challenges of the Australian market.',
            'product_range' => 'With one of the largest adhesive tape ranges in Australia, our products span across cloth, gaffer, masking, foil, PE, UHMW, and double-sided formats.',
            'target_market' => 'Trusted by distributors, trades, and industrial professionals.',
            'distribution_model' => 'We do not sell direct to end users—our tapes are supplied exclusively through our national network of authorized distributors.',
            'commitment' => 'We are dedicated to providing commercial and industrial users with cost-effective adhesive tape solutions for their applications.',
            'support' => 'Our staff are able to be contacted via telephone and email to discuss your adhesive tape requirements and advise you where to contact your nearest Tenacious Tapes Distributor.'
        ];

        return response()->json([
            'success' => true,
            'data' => $overview,
            'message' => 'Brand overview retrieved successfully'
        ]);
    }

    /**
     * Get company information.
     */
    public function company(): JsonResponse
    {
        $brand = Brand::where('is_active', true)->first();
        
        if (!$brand) {
            return response()->json([
                'success' => false,
                'error' => 'Brand not found',
                'message' => 'No active brand information available'
            ], 404);
        }

        $company = [
            'name' => 'Schaffer & Co (VIC) Pty Ltd',
            'brand' => $brand->name,
            'established' => '1960s',
            'type' => 'Fourth-generation, family-owned business',
            'specialization' => 'Adhesive tape importation and conversion',
            'market_leadership' => 'Market leaders and innovators supplying adhesive tape and adhesive tape accessories across Australia',
            'distribution_network' => 'Exclusive range supplied through selected distributors Australia-wide',
            'contact_methods' => [
                'telephone' => $brand->phone,
                'email' => $brand->email,
                'website' => $brand->website,
                'address' => $brand->address
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $company,
            'message' => 'Company information retrieved successfully'
        ]);
    }

    /**
     * Get product categories overview.
     */
    public function categories(): JsonResponse
    {
        $categories = [
            [
                'name' => 'Gaffer Tape',
                'description' => 'Professional matte finish tapes for film, TV, staging, and events',
                'key_features' => ['Low-reflection', 'Clean removal', 'Professional finish'],
                'applications' => ['Film/TV', 'Staging', 'Events', 'Cable bundling']
            ],
            [
                'name' => 'Cloth Tape',
                'description' => 'Strong multipurpose cloth tapes with durable adhesive',
                'key_features' => ['Durable adhesive', 'Multipurpose', 'Strong backing'],
                'applications' => ['Bundling', 'Repairs', 'HVAC', 'Carton sealing']
            ],
            [
                'name' => 'Masking Tape',
                'description' => 'Clean-peel tapes for surface protection and masking',
                'key_features' => ['Clean removal', 'Surface protection', 'Paint masking'],
                'applications' => ['Timber masking', 'Concrete', 'Trade exhibitions']
            ],
            [
                'name' => 'Foil Tape',
                'description' => 'Specialized tapes for heat and moisture resistance',
                'key_features' => ['Heat resistant', 'Moisture resistant', 'Reflective'],
                'applications' => ['HVAC', 'Insulation', 'Heat shielding']
            ],
            [
                'name' => 'PE Film Tape',
                'description' => 'Polyethylene film tapes for packaging and sealing',
                'key_features' => ['Moisture resistant', 'Clear finish', 'Versatile'],
                'applications' => ['Packaging', 'Sealing', 'Protection']
            ],
            [
                'name' => 'UHMW Tape',
                'description' => 'Ultra-high molecular weight tapes for extreme wear resistance',
                'key_features' => ['Wear resistant', 'Low friction', 'Durable'],
                'applications' => ['Industrial', 'Manufacturing', 'Heavy equipment']
            ],
            [
                'name' => 'Double-Sided Tape',
                'description' => 'Adhesive on both sides for bonding applications',
                'key_features' => ['Double-sided adhesive', 'Strong bonding', 'Versatile'],
                'applications' => ['Mounting', 'Bonding', 'Assembly']
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Product categories retrieved successfully'
        ]);
    }

    /**
     * Get featured products from database.
     */
    public function featured(): JsonResponse
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->get();

        if ($featuredProducts->isEmpty()) {
            return response()->json([
                'success' => false,
                'error' => 'No featured products found',
                'message' => 'No featured products are currently available'
            ], 404);
        }

        $featured = $featuredProducts->map(function ($product) {
            return [
                'id' => $product->id,
                'sku' => $product->sku,
                'name' => $product->name,
                'description' => $product->description,
                'category' => $product->category,
                'type' => $product->type,
                'color' => $product->color,
                'width' => $product->width,
                'price' => $product->price,
                'currency' => $product->currency,
                'image_url' => $product->image_url,
                'specifications' => $product->specifications,
                'features' => $product->features,
                'applications' => $product->applications,
                'stock_quantity' => $product->stock_quantity
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $featured,
            'message' => 'Featured products retrieved successfully'
        ]);
    }
}
