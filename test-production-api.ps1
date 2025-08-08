# Test script for Tenacious API with PRODUCTION tokens
$baseUrl = "https://tenacious-api-master-ovrv8p.laravel.cloud/api"

# PRODUCTION tokens (generated with production APP_KEY)
$tokens = @{
    "test_key_123" = "5|XeTpjRzPAHHHXlai7lKGrwOKj90NTBU4jmfP0bVtf2b5f357"
    "creator_dev_2024" = "6|Xx7htqu9G5bJ0yezgP18okVz7AiotgMGUIfvsmbqf8e9542a"
}

Write-Host "=== Tenacious API Production Test ===" -ForegroundColor Green
Write-Host ""

# Test health endpoint (no auth required)
Write-Host "1. Testing /api/health (no auth required):" -ForegroundColor Yellow
try {
    $healthResponse = Invoke-WebRequest -Method GET -Uri "$baseUrl/health"
    Write-Host "Status: SUCCESS ($($healthResponse.StatusCode))" -ForegroundColor Green
    Write-Host "Response: $($healthResponse.Content)" -ForegroundColor White
} catch {
    Write-Host "Status: FAILED" -ForegroundColor Red
    Write-Host "Error: $($_.Exception.Message)" -ForegroundColor Red
}
Write-Host ""

# Test authenticated endpoints
foreach ($tokenName in $tokens.Keys) {
    $token = $tokens[$tokenName]
    Write-Host "2. Testing with token: $tokenName" -ForegroundColor Yellow
    
    # Test products endpoint
    Write-Host "   Testing /api/products:" -ForegroundColor Cyan
    try {
        $productsResponse = Invoke-WebRequest -Method GET -Uri "$baseUrl/products" -Headers @{"Authorization"="Bearer $token"}
        Write-Host "   Status Code: $($productsResponse.StatusCode)" -ForegroundColor Green
        Write-Host "   Response: $($productsResponse.Content.Substring(0, [Math]::Min(200, $productsResponse.Content.Length)))..." -ForegroundColor White
    } catch {
        Write-Host "   Status Code: $($_.Exception.Response.StatusCode.value__)" -ForegroundColor Red
        Write-Host "   Error: $($_.Exception.Message)" -ForegroundColor Red
    }
    Write-Host ""
    
    # Test brand overview endpoint
    Write-Host "   Testing /api/brand/overview:" -ForegroundColor Cyan
    try {
        $brandResponse = Invoke-WebRequest -Method GET -Uri "$baseUrl/brand/overview" -Headers @{"Authorization"="Bearer $token"}
        Write-Host "   Status Code: $($brandResponse.StatusCode)" -ForegroundColor Green
        Write-Host "   Response: $($brandResponse.Content.Substring(0, [Math]::Min(200, $brandResponse.Content.Length)))..." -ForegroundColor White
    } catch {
        Write-Host "   Status Code: $($_.Exception.Response.StatusCode.value__)" -ForegroundColor Red
        Write-Host "   Error: $($_.Exception.Message)" -ForegroundColor Red
    }
    Write-Host ""
}

Write-Host "=== Production Test Complete ===" -ForegroundColor Green 