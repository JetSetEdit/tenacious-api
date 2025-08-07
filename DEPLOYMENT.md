# cPanel Deployment Guide

This guide will help you deploy the Tenacious Tapes API to your cPanel hosting environment.

## 📋 Prerequisites

- cPanel hosting with PHP 8.1+ support
- SQL Server access for Jiwa database
- SSH access (recommended) or File Manager access

## 🚀 Step-by-Step Deployment

### 1. Prepare Your Local Environment

First, ensure your local API is working:

```bash
# Test the API locally
php test-api.php

# Check if all dependencies are installed
composer install --no-dev --optimize-autoloader
```

### 2. Upload Files to cPanel

#### Option A: Using File Manager
1. Log into cPanel
2. Open File Manager
3. Navigate to your domain's root directory
4. Upload the entire `tenacious-api` folder
5. Extract if needed

#### Option B: Using FTP/SFTP (Recommended)
```bash
# Upload using FTP client or command line
ftp your-domain.com
# Upload all files except vendor/ and node_modules/
```

### 3. Configure Document Root

**Important**: Set your document root to point to the `public` folder:

1. In cPanel, go to **Domains** or **Subdomains**
2. Create a subdomain (e.g., `api.yourdomain.com`)
3. Set the document root to: `/tenacious-api/public`
4. Or modify your main domain to point to `/tenacious-api/public`

### 4. Configure Environment

1. In File Manager, navigate to your API folder
2. Edit the `.env` file with your production settings:

```env
APP_NAME="Tenacious Tapes API"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://api.yourdomain.com

# Laravel Database (SQLite for API management)
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/your/database.sqlite

# Jiwa Database Configuration
JIWA_DB_CONNECTION=sqlsrv
JIWA_DB_HOST=your_jiwa_server_ip
JIWA_DB_PORT=1433
JIWA_DB_DATABASE=jiwa_database_name
JIWA_DB_USERNAME=your_jiwa_username
JIWA_DB_PASSWORD=your_jiwa_password

# API Configuration
API_RATE_LIMIT=1000
API_RATE_LIMIT_WINDOW=1440
```

### 5. Set File Permissions

Set the correct permissions for Laravel:

```bash
# Storage and cache directories
chmod 755 storage/
chmod 755 bootstrap/cache/
chmod 755 public/

# Make storage writable
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### 6. Install Dependencies

#### Option A: Using SSH (Recommended)
```bash
# Connect via SSH
ssh username@your-domain.com

# Navigate to your API directory
cd tenacious-api

# Install dependencies
composer install --no-dev --optimize-autoloader
```

#### Option B: Using cPanel Terminal
1. Open cPanel Terminal
2. Navigate to your API directory
3. Run: `composer install --no-dev --optimize-autoloader`

### 7. Run Database Migrations

```bash
# Create the SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate --force
```

### 8. Clear Caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### 9. Test the Deployment

Test your API endpoints:

```bash
# Health check
curl https://api.yourdomain.com/api/health

# Test with API key
curl -H "Authorization: Bearer ata_live_abc123" \
     https://api.yourdomain.com/api/brand/overview
```

## 🔧 Common Issues & Solutions

### Issue: 500 Internal Server Error
**Solution:**
1. Check error logs in cPanel
2. Ensure PHP version is 8.1+
3. Verify file permissions
4. Check `.env` file configuration

### Issue: Database Connection Failed
**Solution:**
1. Verify Jiwa database credentials
2. Check if SQL Server driver is installed
3. Test connection from cPanel server
4. Ensure firewall allows database connections

### Issue: API Routes Not Working
**Solution:**
1. Check if `.htaccess` file exists in `public/`
2. Verify mod_rewrite is enabled
3. Check Apache configuration
4. Ensure document root is set correctly

### Issue: Slow Response Times
**Solution:**
1. Enable OPcache in PHP settings
2. Use Redis for caching (if available)
3. Optimize database queries
4. Enable compression in `.htaccess`

## 📁 File Structure After Deployment

```
public_html/
└── tenacious-api/
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── public/          # Document root points here
    │   ├── index.php
    │   ├── .htaccess
    │   └── ...
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    ├── .env
    └── composer.json
```

## 🔒 Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] Strong API keys configured
- [ ] Database credentials secured
- [ ] File permissions set correctly
- [ ] HTTPS enabled
- [ ] Error logging configured
- [ ] Rate limiting enabled

## 📊 Monitoring

### Enable Error Logging
Add to your `.env`:
```env
LOG_CHANNEL=daily
LOG_LEVEL=error
```

### Monitor API Usage
Check logs in cPanel:
- Error logs: `logs/error_log`
- Access logs: `logs/access_log`

## 🔄 Updates

To update the API in production:

1. **Backup current version**
   ```bash
   cp -r tenacious-api tenacious-api-backup
   ```

2. **Upload new files**
   - Upload new files to a temporary directory
   - Replace old files

3. **Update dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

4. **Run migrations**
   ```bash
   php artisan migrate --force
   ```

5. **Clear caches**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

6. **Test the update**
   ```bash
   curl https://api.yourdomain.com/api/health
   ```

## 📞 Support

If you encounter issues during deployment:

1. Check cPanel error logs
2. Verify PHP version and extensions
3. Test database connectivity
4. Contact your hosting provider
5. Review Laravel logs in `storage/logs/`

## 🎯 Production Checklist

- [ ] Environment configured for production
- [ ] Database connections working
- [ ] API endpoints responding correctly
- [ ] Documentation accessible at `/docs`
- [ ] SSL certificate installed
- [ ] Error logging enabled
- [ ] Performance optimized
- [ ] Security measures in place
- [ ] Backup strategy implemented 