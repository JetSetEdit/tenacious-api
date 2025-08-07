@echo off
echo Testing API Endpoints...
echo.

echo Testing /api/brand/overview:
curl -H "Authorization: Bearer 2|q4rpk4LgS1bw2Dv6wVN5EWMBAJVABeZdtzYONdv573d65392" http://localhost:8000/api/brand/overview
echo.
echo.

echo Testing /api/products:
curl -H "Authorization: Bearer 2|q4rpk4LgS1bw2Dv6wVN5EWMBAJVABeZdtzYONdv573d65392" http://localhost:8000/api/products
echo.
echo.

echo Test Complete! 