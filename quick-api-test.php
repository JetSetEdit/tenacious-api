<?php

$baseUrl = 'http://localhost:8000/api';
$apiToken = '2|q4rpk4LgS1bw2Dv6wVN5EWMBAJVABeZdtzYONdv573d65392';

echo "🔧 Quick API Test\n";
echo "================\n\n";

// Test Brand Overview
echo "1️⃣ Testing /api/brand/overview:\n";
$response = makeRequest($baseUrl . '/brand/overview', $apiToken);
echo "Status: " . $response['status'] . "\n";
if ($response['status'] === 200) {
    echo "✅ SUCCESS - Brand data loaded from database\n";
} else {
    echo "❌ FAILED\n";
}
echo "\n";

// Test Products
echo "2️⃣ Testing /api/products:\n";
$response = makeRequest($baseUrl . '/products', $apiToken);
echo "Status: " . $response['status'] . "\n";
if ($response['status'] === 200) {
    $products = $response['data']['data'];
    echo "✅ SUCCESS - " . count($products) . " products loaded from database\n";
} else {
    echo "❌ FAILED\n";
}

function makeRequest($url, $token = null) {
    $ch = curl_init();
    $headers = ['Content-Type: application/json', 'Accept: application/json'];
    if ($token) $headers[] = 'Authorization: Bearer ' . $token;
    
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ['status' => $httpCode, 'data' => json_decode($response, true) ?: $response];
} 