Write-Host "Quick API Test - Brand Overview & Products" -ForegroundColor Green
Write-Host "============================================" -ForegroundColor Green
Write-Host ""

$apiToken = "2|q4rpk4LgS1bw2Dv6wVN5EWMBAJVABeZdtzYONdv573d65392"
$baseUrl = "http://localhost:8000/api"

# Test Brand Overview
Write-Host "1. Testing /api/brand/overview:" -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/brand/overview" -Headers @{
        "Authorization" = "Bearer $apiToken"
        "Content-Type" = "application/json"
        "Accept" = "application/json"
    } -Method Get
    Write-Host "SUCCESS - Brand data loaded from database" -ForegroundColor Green
    Write-Host "Company: $($response.data.company_name)" -ForegroundColor Cyan
} catch {
    Write-Host "FAILED: $($_.Exception.Message)" -ForegroundColor Red
}
Write-Host ""

# Test Products
Write-Host "2. Testing /api/products:" -ForegroundColor Yellow
try {
    $response = Invoke-RestMethod -Uri "$baseUrl/products" -Headers @{
        "Authorization" = "Bearer $apiToken"
        "Content-Type" = "application/json"
        "Accept" = "application/json"
    } -Method Get
    Write-Host "SUCCESS - $($response.data.Count) products loaded from database" -ForegroundColor Green
    Write-Host "Categories: $($response.data.category | Select-Object -Unique -Join ', ')" -ForegroundColor Cyan
} catch {
    Write-Host "FAILED: $($_.Exception.Message)" -ForegroundColor Red
}
Write-Host ""

Write-Host "Test Complete!" -ForegroundColor Green 