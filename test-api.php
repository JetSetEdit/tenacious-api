<?php

// Simple API test script
$baseUrl = 'http://localhost:8000/api';

echo "Testing Tenacious Tapes API...\n\n";

// Test 1: Health check
echo "1. Testing health endpoint...\n";
$response = file_get_contents($baseUrl . '/health');
$data = json_decode($response, true);
echo "Status: " . ($data['success'] ? 'PASS' : 'FAIL') . "\n";
echo "Message: " . $data['message'] . "\n\n";

// Test 2: API key validation
echo "2. Testing API key validation...\n";
$context = stream_context_create([
    'http' => [
        'header' => "Authorization: Bearer ata_live_abc123\r\n"
    ]
]);
$response = file_get_contents($baseUrl . '/auth/validate', false, $context);
$data = json_decode($response, true);
echo "Status: " . ($data['success'] ? 'PASS' : 'FAIL') . "\n";
echo "Client: " . $data['data']['client'] . "\n\n";

// Test 3: Brand overview (requires auth)
echo "3. Testing brand overview (with auth)...\n";
$response = file_get_contents($baseUrl . '/brand/overview', false, $context);
$data = json_decode($response, true);
echo "Status: " . ($data['success'] ? 'PASS' : 'FAIL') . "\n";
echo "Company: " . $data['data']['company_name'] . "\n\n";

// Test 4: Featured products
echo "4. Testing featured products...\n";
$response = file_get_contents($baseUrl . '/brand/featured', false, $context);
$data = json_decode($response, true);
echo "Status: " . ($data['success'] ? 'PASS' : 'FAIL') . "\n";
echo "Products found: " . count($data['data']) . "\n\n";

// Test 5: Invalid API key
echo "5. Testing invalid API key...\n";
$context = stream_context_create([
    'http' => [
        'header' => "Authorization: Bearer invalid_key\r\n"
    ]
]);
$response = file_get_contents($baseUrl . '/auth/validate', false, $context);
$data = json_decode($response, true);
echo "Status: " . (!$data['success'] ? 'PASS' : 'FAIL') . "\n";
echo "Error: " . $data['error'] . "\n\n";

echo "API testing completed!\n";
echo "Documentation available at: http://localhost:8000/docs\n"; 