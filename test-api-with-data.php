<?php

/**
 * Test script to verify API endpoints with new database data
 */

$baseUrl = 'http://localhost:8000/api';
$apiToken = '2|q4rpk4LgS1bw2Dv6wVN5EWMBAJVABeZdtzYONdv573d65392';

echo "🔧 Testing Tenacious Tapes API with Database Data\n";
echo "================================================\n\n";

// Test 1: Health check
echo "1️⃣ Testing health endpoint:\n";
$response = makeRequest($baseUrl . '/health');
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['data'], JSON_PRETTY_PRINT) . "\n\n";

// Test 2: Brand overview
echo "2️⃣ Testing brand overview endpoint:\n";
$response = makeRequest($baseUrl . '/brand/overview', $apiToken);
echo "Status: " . $response['status'] . "\n";
echo "Response: " . json_encode($response['data'], JSON_PRETTY_PRINT) . "\n\n";

// Test 3: All products
echo "3️⃣ Testing products endpoint:\n";
$response = makeRequest($baseUrl . '/products', $apiToken);
echo "Status: " . $response['status'] . "\n";
echo "Product count: " . count($response['data']['data']) . "\n\n";

// Test 4: Featured products
echo "4️⃣ Testing featured products endpoint:\n";
$response = makeRequest($baseUrl . '/brand/featured', $apiToken);
echo "Status: " . $response['status'] . "\n";
echo "Featured product count: " . count($response['data']['data']) . "\n\n";

echo "✅ API testing completed!\n";

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