<?php

/**
 * Tenacious API Test Script
 * Run this script to test your API endpoints
 */

$baseUrl = 'https://tenacious-api-master-ovrv8p.laravel.cloud';

echo "🔗 Testing Tenacious API Endpoints\n";
echo "===================================\n\n";

// Test 1: Health Check (No Auth Required)
echo "1. Testing Health Check...\n";
$healthResponse = testEndpoint($baseUrl . '/api/health');
echo "Status: " . $healthResponse['status'] . "\n";
echo "Response: " . $healthResponse['body'] . "\n\n";

// Test 2: Auth Validation (No Auth Required)
echo "2. Testing Auth Validation (No Key)...\n";
$authResponse = testEndpoint($baseUrl . '/api/auth/validate');
echo "Status: " . $authResponse['status'] . "\n";
echo "Response: " . $authResponse['body'] . "\n\n";

// Test 3: Auth Validation with Valid Key
echo "3. Testing Auth Validation (Valid Key)...\n";
$validAuthResponse = testEndpoint($baseUrl . '/api/auth/validate', 'ata_live_abc123');
echo "Status: " . $validAuthResponse['status'] . "\n";
echo "Response: " . $validAuthResponse['body'] . "\n\n";

// Test 4: Products (Requires Auth)
echo "4. Testing Products (No Auth)...\n";
$productsResponse = testEndpoint($baseUrl . '/api/products');
echo "Status: " . $productsResponse['status'] . "\n";
echo "Response: " . $productsResponse['body'] . "\n\n";

// Test 5: Products with Valid Auth
echo "5. Testing Products (Valid Auth)...\n";
$validProductsResponse = testEndpoint($baseUrl . '/api/products', 'ata_live_abc123');
echo "Status: " . $validProductsResponse['status'] . "\n";
echo "Response: " . $validProductsResponse['body'] . "\n\n";

// Test 6: Brand Overview (Requires Auth)
echo "6. Testing Brand Overview (Valid Auth)...\n";
$brandResponse = testEndpoint($baseUrl . '/api/brand/overview', 'ata_live_abc123');
echo "Status: " . $brandResponse['status'] . "\n";
echo "Response: " . $brandResponse['body'] . "\n\n";

// Test 7: Creator Key Test
echo "7. Testing Creator Key (New)...\n";
$creatorResponse = testEndpoint($baseUrl . '/api/auth/validate', 'creator_dev_2024');
echo "Status: " . $creatorResponse['status'] . "\n";
echo "Response: " . $creatorResponse['body'] . "\n\n";

echo "✅ Testing Complete!\n";

function testEndpoint($url, $apiKey = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $headers = [
        'Content-Type: application/json',
        'Accept: application/json'
    ];
    
    if ($apiKey) {
        $headers[] = 'Authorization: Bearer ' . $apiKey;
    }
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    curl_close($ch);
    
    if ($error) {
        return [
            'status' => 'ERROR',
            'body' => 'cURL Error: ' . $error
        ];
    }
    
    return [
        'status' => $httpCode,
        'body' => $response
    ];
}

?> 