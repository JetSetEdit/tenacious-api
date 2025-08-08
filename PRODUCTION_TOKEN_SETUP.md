# Production Token Setup - Required Action

## Current Issue

The 500 Internal Server Error is occurring because the API tokens generated locally are not available in the production environment. Each environment (local vs production) has its own database, so tokens need to be generated on the production server.

## Solution: Generate Tokens on Production Server

### Step 1: Access the Production Server

You need to access the production server where the Laravel application is deployed and run the token generation commands.

### Step 2: Generate Production Tokens

On the production server, run these commands:

```bash
# Navigate to the Laravel application directory
cd /path/to/tenacious-api

# Generate tokens for the required partners
php artisan api:generate-token test_key_123
php artisan api:generate-token creator_dev_2024
```

### Step 3: Use the Production Tokens

The commands will output the actual tokens. Use those tokens in your API requests:

```powershell
# Example (replace with actual tokens from production)
Invoke-WebRequest -Method GET -Uri "https://tenacious-api-master-ovrv8p.laravel.cloud/api/products" -Headers @{"Authorization"="Bearer PRODUCTION_TOKEN_HERE"}
```

## Alternative: Check Existing Tokens

If tokens already exist on production, you can check them by:

1. **Accessing the production database** and checking the `personal_access_tokens` table
2. **Running a database query** to see existing tokens
3. **Checking with the system administrator** who deployed the application

## Verification Steps

After generating tokens on production:

1. **Test the health endpoint** (should work without auth):
   ```powershell
   Invoke-WebRequest -Method GET -Uri "https://tenacious-api-master-ovrv8p.laravel.cloud/api/health"
   ```

2. **Test authenticated endpoints** with the new tokens:
   ```powershell
   Invoke-WebRequest -Method GET -Uri "https://tenacious-api-master-ovrv8p.laravel.cloud/api/products" -Headers @{"Authorization"="Bearer NEW_TOKEN"}
   ```

## Expected Results

Once tokens are properly generated on production:
- ✅ `/api/health` returns 200 OK
- ✅ `/api/products` returns 200 OK with JSON data
- ✅ `/api/brand/overview` returns 200 OK with JSON data
- ❌ No more 500 Internal Server Errors

## Security Considerations

1. **Token Storage**: Store production tokens securely
2. **Token Rotation**: Consider implementing token rotation for security
3. **Access Control**: Limit who has access to generate tokens
4. **Monitoring**: Monitor token usage for security

## Troubleshooting

If you still get 500 errors after generating tokens on production:

1. **Check Laravel logs** on the production server
2. **Verify database connectivity** on production
3. **Ensure migrations are run** on production
4. **Check if data exists** in the products and brands tables

## Next Steps

1. **Contact your system administrator** or DevOps team to access the production server
2. **Generate the required tokens** using the commands above
3. **Update your API client** with the new production tokens
4. **Test all endpoints** to confirm they're working
5. **Document the tokens** for future reference 