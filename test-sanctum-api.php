<?php

/**
 * Test script to demonstrate Laravel Sanctum API authentication
 * 
 * This script shows how to use the generated API token with the Tenacious Tapes API
 */

$baseUrl = 'http://localhost:8000/api';
$apiToken = '2|q4rpk4LgS1bw2Dv6wVN5EWMBAJVABeZdtzYONdv573d65392';

echo "🔧 Testing Tenacious Tapes API with Laravel Sanctum\n";
echo "==================================================\n\n";

// Test 1: Health check (no auth required)
echo "1️⃣ Testing health endpoint (no auth required):\n";
$response = makeRequest($baseUrl . '/health');
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['data'], JSON_PRETTY_PRINT) . "\n\n";

// Test 2: Validate API token
echo "2️⃣ Testing API token validation:\n";
$response = makeRequest($baseUrl . '/auth/validate', $apiToken);
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['data'], JSON_PRETTY_PRINT) . "\n\n";

// Test 3: Get usage information (requires auth)
echo "3️⃣ Testing authenticated endpoint (usage):\n";
$response = makeRequest($baseUrl . '/auth/usage', $apiToken);
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['data'], JSON_PRETTY_PRINT) . "\n\n";

// Test 4: Get endpoints (requires auth)
echo "4️⃣ Testing authenticated endpoint (endpoints):\n";
$response = makeRequest($baseUrl . '/auth/endpoints', $apiToken);
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['data'], JSON_PRETTY_PRINT) . "\n\n";

// Test 5: Test products endpoint (requires auth)
echo "5️⃣ Testing products endpoint (requires auth):\n";
$response = makeRequest($baseUrl . '/products', $apiToken);
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['data'], JSON_PRETTY_PRINT) . "\n\n";

// Test 6: Test with invalid token
echo "6️⃣ Testing with invalid token:\n";
$response = makeRequest($baseUrl . '/auth/usage', 'invalid_token_123');
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['data'], JSON_PRETTY_PRINT) . "\n\n";

echo "✅ Sanctum API testing completed!\n";
echo "💡 The API is now using Laravel Sanctum for secure token-based authentication.\n";

function makeRequest($url, $token = null) {
    $ch = curl_init();
    
    $headers = [
        'Content-Type: application/json',
        'Accept: application/json'
    ];
    
    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }
    
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'status' => $httpCode,
        'data' => json_decode($response, true) ?: $response
    ];
} 