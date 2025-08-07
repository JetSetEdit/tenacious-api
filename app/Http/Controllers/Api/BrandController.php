<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    /**
     * Get brand overview information.
     */
    public function overview(): JsonResponse
    {
        $overview = [
            'company_name' => 'Tenacious Tapes',
            'parent_company' => 'Schaffer & Co (VIC) Pty Ltd',
            'description' => 'Tenacious Tapes is the house brand of Schaffer & Co (VIC) Pty Ltd, a fourth-generation, family-owned business with a legacy in adhesive tape importation and conversion dating back to the mid-1960s.',
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
        $company = [
            'name' => 'Schaffer & Co (VIC) Pty Ltd',
            'brand' => 'Tenacious Tapes',
            'established' => '1960s',
            'type' => 'Fourth-generation, family-owned business',
            'specialization' => 'Adhesive tape importation and conversion',
            'market_leadership' => 'Market leaders and innovators supplying adhesive tape and adhesive tape accessories across Australia',
            'distribution_network' => 'Exclusive range supplied through selected distributors Australia-wide',
            'contact_methods' => [
                'telephone' => 'Available for technical advice',
                'email' => 'Available for product support'
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
     * Get featured products (from your ATA document).
     */
    public function featured(): JsonResponse
    {
        $featured = [
            [
                'product_code' => 'A944',
                'name' => 'Premium Gaffer Tape',
                'description' => 'Professional matte finish; low-reflection, clean removal',
                'colors' => ['Black', 'White'],
                'widths' => ['24mm', '48mm', '72mm'],
                'adhesive_type' => 'Rubber',
                'common_uses' => ['Film/TV', 'staging', 'events', 'cable bundling']
            ],
            [
                'product_code' => 'K969',
                'name' => 'General Purpose Cloth',
                'description' => 'Strong multipurpose cloth tape with durable adhesive',
                'colors' => ['Silver', 'Black'],
                'widths' => ['48mm'],
                'adhesive_type' => 'Rubber',
                'common_uses' => ['Bundling', 'repairs', 'HVAC', 'carton sealing']
            ],
            [
                'product_code' => 'K909',
                'name' => 'Contractor Cloth Tape',
                'description' => 'Economy cloth tape for basic bundling and sealing',
                'colors' => ['Black', 'Grey'],
                'widths' => ['48mm', '72mm'],
                'adhesive_type' => 'Synthetic',
                'common_uses' => ['Construction', 'temporary repairs']
            ],
            [
                'product_code' => 'AT760',
                'name' => 'High Strength Gaffer',
                'description' => 'Extra adhesive strength for demanding applications',
                'colors' => ['Black', 'Yellow'],
                'widths' => ['48mm', '72mm'],
                'adhesive_type' => 'Rubber',
                'common_uses' => ['Theatre', 'flooring', 'warehouse staging']
            ],
            [
                'product_code' => 'FL166',
                'name' => 'Fluorescent Cloth Tape',
                'description' => 'Fluoro colours for visibility and tagging in WHS environments',
                'colors' => ['Pink', 'Green', 'Orange'],
                'widths' => ['48mm'],
                'adhesive_type' => 'Rubber',
                'common_uses' => ['Safety marking', 'tool identification', 'WHS']
            ],
            [
                'product_code' => 'PT159',
                'name' => 'Painter\'s Gaffer Hybrid',
                'description' => 'Clean-peel cloth tape for rough surface masking',
                'colors' => ['White'],
                'widths' => ['36mm', '48mm'],
                'adhesive_type' => 'Acrylic',
                'common_uses' => ['Timber masking', 'concrete', 'trade exhibitions']
            ],
            [
                'product_code' => 'KD960',
                'name' => 'Weather Resistant Cloth',
                'description' => 'Flexible outdoor cloth tape with water-repellent backing',
                'colors' => ['Black'],
                'widths' => ['48mm'],
                'adhesive_type' => 'Rubber',
                'common_uses' => ['Outdoor sealing', 'tarp repair', 'patch jobs']
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $featured,
            'message' => 'Featured products retrieved successfully'
        ]);
    }
}
