# Tenacious Tapes API

A professional REST API for Tenacious Tapes, providing access to product data from Jiwa database and brand information for platinum sponsors (ATA, NDA).

## 🚀 Features

- **Jiwa Database Integration**: Real-time access to product inventory and data
- **Brand Information**: Static content about Tenacious Tapes and company information
- **API Key Authentication**: Secure access control for different clients
- **Rate Limiting**: Configurable rate limits per client
- **Professional Documentation**: Auto-generated API documentation
- **cPanel Compatible**: Works seamlessly with cPanel hosting

## 📋 Requirements

- PHP 8.1+
- Laravel 12
- SQL Server (for Jiwa database)
- SQLite (for API user management)

## 🛠 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd tenacious-api
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Update database configuration**
   Edit `.env` file with your Jiwa database credentials:
   ```env
   # Jiwa Database Configuration
   JIWA_DB_CONNECTION=sqlsrv
   JIWA_DB_HOST=your_jiwa_server
   JIWA_DB_PORT=1433
   JIWA_DB_DATABASE=jiwa_database_name
   JIWA_DB_USERNAME=your_jiwa_username
   JIWA_DB_PASSWORD=your_jiwa_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```

## 🔑 API Keys

The API uses the following test keys:

- **ATA Distributors**: `ata_live_abc123`
- **NDA Distributors**: `nda_live_xyz789`
- **Test Client**: `test_key_123`

## 📚 API Endpoints

### Authentication
- `GET /api/auth/validate` - Validate API key
- `GET /api/auth/usage` - Get usage statistics
- `GET /api/auth/endpoints` - Get available endpoints

### Products (Jiwa Data)
- `GET /api/products` - List all products
- `GET /api/products/{id}` - Get specific product
- `GET /api/products/search?q={query}` - Search products
- `GET /api/products/categories` - Get product categories
- `GET /api/products/category/{id}` - Get products by category

### Brand Information
- `GET /api/brand/overview` - Get brand overview
- `GET /api/brand/company` - Get company information
- `GET /api/brand/categories` - Get product categories overview
- `GET /api/brand/featured` - Get featured products

## 🔧 Configuration

### Rate Limits
- **Platinum Clients**: 1,000 requests per day
- **Test Clients**: 100 requests per day

### Database Connections
The API uses two database connections:
1. **Default (SQLite)**: For API user management and tokens
2. **Jiwa (SQL Server)**: For product data and inventory

## 📖 Usage Examples

### JavaScript (Fetch)
```javascript
const response = await fetch('/api/products', {
    headers: {
        'Authorization': 'Bearer ata_live_abc123',
        'Content-Type': 'application/json'
    }
});
const data = await response.json();
```

### cURL
```bash
curl -X GET "http://localhost/api/products" \
  -H "Authorization: Bearer ata_live_abc123" \
  -H "Content-Type: application/json"
```

### PHP
```php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost/api/products");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer ata_live_abc123",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response, true);
```

## 🧪 Testing

Run the test script to verify API functionality:
```bash
php test-api.php
```

## 📖 Documentation

Access the interactive API documentation at:
```
http://localhost:8000/docs
```

## 🚀 Deployment

### cPanel Deployment
1. Upload files to your cPanel hosting
2. Set document root to `/public`
3. Configure database connections in `.env`
4. Run migrations: `php artisan migrate`

### Environment Variables
Ensure these are set in production:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `JIWA_DB_*` (Jiwa database credentials)

## 🔒 Security

- API keys are validated on every request
- Rate limiting prevents abuse
- SQL injection protection via Laravel's query builder
- CORS protection enabled
- Input validation and sanitization

## 📞 Support

For technical support:
- **Email**: support@tenacioustapes.com
- **Phone**: Available for technical advice
- **Documentation**: `/docs` endpoint

## 🏗 Architecture

```
tenacious-api/
├── app/
│   ├── Http/Controllers/Api/
│   │   ├── ProductController.php    # Jiwa product data
│   │   ├── BrandController.php      # Static brand content
│   │   └── AuthController.php       # API key management
│   └── Http/Middleware/
│       └── ApiKeyMiddleware.php     # API key validation
├── config/
│   └── database.php                 # Database connections
├── routes/
│   └── api.php                      # API routes
├── resources/views/
│   └── documentation/               # API documentation
└── .env                             # Configuration
```

## 🔄 Response Format

All API responses follow this format:
```json
{
  "success": true,
  "data": { ... },
  "message": "Operation completed successfully"
}
```

Error responses:
```json
{
  "success": false,
  "error": "Error type",
  "message": "Detailed error message"
}
```

## 📈 Monitoring

- API usage tracking per client
- Rate limit monitoring
- Error logging and monitoring
- Performance metrics

## 🔄 Updates

To update the API:
1. Pull latest changes
2. Run `composer install`
3. Run `php artisan migrate` (if needed)
4. Clear cache: `php artisan cache:clear`

## 📄 License

This API is proprietary to Tenacious Tapes and Schaffer & Co (VIC) Pty Ltd.
