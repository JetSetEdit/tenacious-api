<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Validate API key and return client information.
     */
    public function validate(Request $request): JsonResponse
    {
        $apiKey = $request->header('Authorization');
        
        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'error' => 'API key required',
                'message' => 'Please provide an API key in the Authorization header'
            ], 401);
        }

        // Remove 'Bearer ' prefix if present
        $apiKey = str_replace('Bearer ', '', $apiKey);

        // Valid API keys and their client information
        $validKeys = [
            'ata_live_abc123' => [
                'client' => 'ATA',
                'name' => 'ATA Distributors',
                'access_level' => 'platinum',
                'rate_limit' => 1000,
                'rate_limit_window' => 'daily',
                'permissions' => ['products', 'brand', 'categories', 'search']
            ],
            'nda_live_xyz789' => [
                'client' => 'NDA',
                'name' => 'NDA Distributors',
                'access_level' => 'platinum',
                'rate_limit' => 1000,
                'rate_limit_window' => 'daily',
                'permissions' => ['products', 'brand', 'categories', 'search']
            ],
            'test_key_123' => [
                'client' => 'TEST',
                'name' => 'Test Client',
                'access_level' => 'test',
                'rate_limit' => 100,
                'rate_limit_window' => 'daily',
                'permissions' => ['products', 'brand', 'categories', 'search']
            ],
            'creator_dev_2024' => [
                'client' => 'CREATOR',
                'name' => 'API Creator & Developer',
                'access_level' => 'developer',
                'rate_limit' => 5000,
                'rate_limit_window' => 'daily',
                'permissions' => ['products', 'brand', 'categories', 'search', 'admin', 'debug']
            ]
        ];

        if (!array_key_exists($apiKey, $validKeys)) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key',
                'message' => 'The provided API key is not valid'
            ], 401);
        }

        $clientInfo = $validKeys[$apiKey];
        $clientInfo['api_key'] = substr($apiKey, 0, 8) . '...'; // Show only first 8 characters

        return response()->json([
            'success' => true,
            'data' => $clientInfo,
            'message' => 'API key validated successfully'
        ]);
    }

    /**
     * Get API usage information for the authenticated client.
     */
    public function usage(Request $request): JsonResponse
    {
        $client = $request->get('api_client');
        
        if (!$client) {
            return response()->json([
                'success' => false,
                'error' => 'Client information not found',
                'message' => 'Unable to determine client from API key'
            ], 400);
        }

        // Mock usage data - in production this would come from a database
        $usage = [
            'client' => $client,
            'period' => 'current_month',
            'requests_made' => rand(50, 500), // Mock data
            'requests_remaining' => 1000 - rand(50, 500), // Mock data
            'rate_limit' => 1000,
            'rate_limit_reset' => now()->addDay()->toISOString(),
            'endpoints_used' => [
                'products' => rand(10, 100),
                'brand' => rand(5, 50),
                'categories' => rand(5, 30),
                'search' => rand(20, 150)
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $usage,
            'message' => 'Usage information retrieved successfully'
        ]);
    }

    /**
     * Get available API endpoints for the authenticated client.
     */
    public function endpoints(Request $request): JsonResponse
    {
        $client = $request->get('api_client');
        
        $endpoints = [
            'base_url' => config('app.url') . '/api/v1',
            'authentication' => [
                'method' => 'Bearer Token',
                'header' => 'Authorization: Bearer YOUR_API_KEY'
            ],
            'endpoints' => [
                'products' => [
                    'GET /products' => 'List all products',
                    'GET /products/{id}' => 'Get specific product',
                    'GET /products/search?q={query}' => 'Search products',
                    'GET /products/categories' => 'Get product categories',
                    'GET /products/category/{id}' => 'Get products by category'
                ],
                'brand' => [
                    'GET /brand/overview' => 'Get brand overview',
                    'GET /brand/company' => 'Get company information',
                    'GET /brand/categories' => 'Get product categories overview',
                    'GET /brand/featured' => 'Get featured products'
                ],
                'auth' => [
                    'GET /auth/validate' => 'Validate API key',
                    'GET /auth/usage' => 'Get usage information',
                    'GET /auth/endpoints' => 'Get available endpoints'
                ]
            ],
            'rate_limits' => [
                'platinum_clients' => '1000 requests per day',
                'test_clients' => '100 requests per day'
            ],
            'response_format' => [
                'success' => 'boolean',
                'data' => 'array|object',
                'message' => 'string',
                'error' => 'string (only on errors)'
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $endpoints,
            'message' => 'API endpoints retrieved successfully'
        ]);
    }
}
