# Laravel Sanctum API Authentication Setup

## ✅ Confirmation: Laravel Sanctum is the Best Tool

You were absolutely correct! **Laravel Sanctum is already installed and is the best tool for API key authentication.** Here's what we've accomplished:

### What Was Already in Place:
- ✅ **Sanctum Package**: `laravel/sanctum": "^4.2"` installed
- ✅ **Configuration**: `config/sanctum.php` properly configured
- ✅ **Database Tables**: Sanctum migrations already run

### What We've Set Up:
- ✅ **User Model**: Added `HasApiTokens` trait
- ✅ **API Routes**: Updated to use `auth:sanctum` middleware
- ✅ **Auth Controller**: Updated to work with Sanctum authentication
- ✅ **Token Generation**: Created Artisan command for easy token creation
- ✅ **Testing**: Created test scripts to verify functionality

## 🔑 How to Generate API Keys

### Using the Artisan Command (Recommended)

```bash
# Generate a token for ATA Distributors
php artisan api:generate-token ATA_Distributors

# Generate a token for a different partner
php artisan api:generate-token NDA_Distributors

# Generate a token for a specific user (default is user ID 1)
php artisan api:generate-token Test_Partner --user-id=1
```

### Using Tinker (Alternative)

```bash
php artisan tinker
```

Then in the interactive console:
```php
$user = App\Models\User::find(1);
$token = $user->createToken('ATA_Distributors_Token')->plainTextToken;
echo $token;
```

## 🔒 Security Features

Laravel Sanctum provides enterprise-grade security:

### **Cryptographic Security**
- Tokens are **cryptographically secure** and practically impossible to guess
- Each token is **64 characters long** with high entropy
- Example: `2|q4rpk4LgS1bw2Dv6wVN5EWMBAJVABeZdtzYONdv573d65392`

### **Database Hashing**
- Tokens are **hashed before storage** in the database
- Even if database is compromised, actual tokens remain secure
- Uses Laravel's built-in hashing mechanisms

### **Token Management**
- Tokens can be **revoked** individually
- **Expiration dates** can be set
- **Usage tracking** (last_used_at)
- **Token naming** for easy identification

## 📋 API Usage

### Authentication Header
```http
Authorization: Bearer 2|q4rpk4LgS1bw2Dv6wVN5EWMBAJVABeZdtzYONdv573d65392
```

### Available Endpoints

#### Public Endpoints (No Auth Required)
- `GET /api/health` - Check API status

#### Protected Endpoints (Require Auth)
- `GET /api/auth/validate` - Validate API key
- `GET /api/auth/usage` - Get usage information
- `GET /api/auth/endpoints` - Get available endpoints
- `GET /api/products` - List products
- `GET /api/products/{id}` - Get specific product
- `GET /api/products/search` - Search products
- `GET /api/brand/overview` - Get brand overview
- And more...

## 🧪 Testing the API

### Run the Test Script
```bash
php test-sanctum-api.php
```

### Manual Testing with curl
```bash
# Health check (no auth)
curl http://localhost:8000/api/health

# Validate token
curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8000/api/auth/validate

# Get products (requires auth)
curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8000/api/products
```

## 🗄️ Database Structure

Sanctum creates and manages these tables:

### `personal_access_tokens`
- `id` - Primary key
- `tokenable_type` - Model class (e.g., App\Models\User)
- `tokenable_id` - User ID
- `name` - Token name (e.g., "ATA_Distributors")
- `token` - Hashed token value
- `abilities` - JSON array of permissions
- `last_used_at` - Last usage timestamp
- `expires_at` - Expiration date (optional)
- `created_at` / `updated_at` - Timestamps

## 🔧 Token Management Commands

### List All Tokens for a User
```php
// In tinker
$user = App\Models\User::find(1);
$user->tokens; // Shows all tokens
```

### Revoke a Token
```php
// In tinker
$user = App\Models\User::find(1);
$user->tokens()->where('name', 'ATA_Distributors')->delete();
```

### Revoke All Tokens
```php
// In tinker
$user = App\Models\User::find(1);
$user->tokens()->delete();
```

## 🚀 Production Deployment

### Environment Variables
```env
SANCTUM_STATEFUL_DOMAINS=yourdomain.com,api.yourdomain.com
SANCTUM_TOKEN_PREFIX=your_prefix_  # Optional: adds prefix to tokens
```

### Security Best Practices
1. **Use HTTPS** in production
2. **Set token expiration** for sensitive applications
3. **Monitor token usage** and revoke unused tokens
4. **Use token prefixes** for easier identification
5. **Implement rate limiting** on your API endpoints

## 📊 Benefits Over Custom Solution

| Feature | Custom API Keys | Laravel Sanctum |
|---------|----------------|-----------------|
| **Security** | Manual hashing | Built-in cryptographic security |
| **Token Generation** | Manual implementation | Secure random generation |
| **Database Storage** | Custom tables | Optimized schema |
| **Token Revocation** | Manual implementation | Built-in methods |
| **Expiration** | Manual tracking | Built-in support |
| **Usage Tracking** | Manual implementation | Automatic tracking |
| **Laravel Integration** | Custom middleware | Native middleware |
| **Maintenance** | High | Low |

## 🎯 Next Steps

1. **Generate tokens** for your partners using the Artisan command
2. **Test the API** with the provided test script
3. **Deploy to production** with proper environment configuration
4. **Monitor usage** and implement rate limiting as needed
5. **Set up token expiration** for enhanced security

---

**You now have a production-ready, secure API authentication system using Laravel Sanctum!** 🎉 