<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiKey;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('Authorization');
        
        if (!$apiKey) {
            return response()->json([
                'error' => 'API key required',
                'message' => 'Please provide an API key in the Authorization header'
            ], 401);
        }

        // Remove 'Bearer ' prefix if present
        $apiKey = str_replace('Bearer ', '', $apiKey);

        // For now, we'll use a simple validation
        // In production, you'd want to store API keys in the database
        $validKeys = [
            'ata_live_abc123' => 'ATA',
            'nda_live_xyz789' => 'NDA',
            'test_key_123' => 'TEST'
        ];

        if (!array_key_exists($apiKey, $validKeys)) {
            return response()->json([
                'error' => 'Invalid API key',
                'message' => 'The provided API key is not valid'
            ], 401);
        }

        // Add the client info to the request for use in controllers
        $request->merge(['api_client' => $validKeys[$apiKey]]);

        return $next($request);
    }
}
