<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tenacious API - Industrial Tape Solutions</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <style>
            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
                margin: 0;
                padding: 20px;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .container {
                background: white;
                border-radius: 16px;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
                max-width: 1200px;
                width: 100%;
                overflow: hidden;
            }
            .header {
                background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
                color: white;
                padding: 40px;
                text-align: center;
            }
            .header h1 {
                font-size: 3rem;
                font-weight: 700;
                margin: 0 0 10px 0;
            }
            .header p {
                font-size: 1.25rem;
                opacity: 0.9;
                margin: 0;
            }
            .content {
                padding: 40px;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 40px;
            }
            .api-info {
                background: #f8fafc;
                padding: 30px;
                border-radius: 12px;
                border-left: 4px solid #dc2626;
            }
            .api-info h2 {
                color: #1e293b;
                margin: 0 0 20px 0;
                font-size: 1.5rem;
            }
            .endpoint {
                background: white;
                padding: 15px;
                margin: 10px 0;
                border-radius: 8px;
                border: 1px solid #e2e8f0;
            }
            .endpoint .method {
                display: inline-block;
                background: #10b981;
                color: white;
                padding: 4px 8px;
                border-radius: 4px;
                font-size: 0.75rem;
                font-weight: 600;
                margin-right: 10px;
            }
            .endpoint .url {
                font-family: 'Courier New', monospace;
                color: #374151;
            }
            .endpoint .description {
                color: #6b7280;
                font-size: 0.875rem;
                margin-top: 5px;
            }
            .status {
                text-align: center;
                padding: 20px;
            }
            .status-indicator {
                display: inline-block;
                width: 12px;
                height: 12px;
                background: #10b981;
                border-radius: 50%;
                margin-right: 8px;
                animation: pulse 2s infinite;
            }
            @keyframes pulse {
                0% { opacity: 1; }
                50% { opacity: 0.5; }
                100% { opacity: 1; }
            }
            .footer {
                background: #1e293b;
                color: white;
                padding: 20px;
                text-align: center;
            }
            .footer a {
                color: #60a5fa;
                text-decoration: none;
            }
            .footer a:hover {
                text-decoration: underline;
            }
            @media (max-width: 768px) {
                .content {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }
                .header h1 {
                    font-size: 2rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>🔗 Tenacious API</h1>
                <p>Industrial Tape Solutions & Distribution Network</p>
            </div>
            
            <div class="content">
                <div class="api-info">
                    <h2>🚀 API Status</h2>
                    <div class="status">
                        <span class="status-indicator"></span>
                        <strong>API is running successfully</strong>
                        <p>Version 1.0.0 | Deployed on Laravel Cloud</p>
                    </div>
                    
                    <h2>📋 Available Endpoints</h2>
                    
                    <div class="endpoint">
                        <span class="method">GET</span>
                        <span class="url">/api/health</span>
                        <div class="description">Check API status and version information</div>
                    </div>
                    
                    <div class="endpoint">
                        <span class="method">GET</span>
                        <span class="url">/api/auth/validate</span>
                        <div class="description">Validate API key and get client information</div>
                    </div>
                    
                    <div class="endpoint">
                        <span class="method">GET</span>
                        <span class="url">/api/products</span>
                        <div class="description">List all available products (requires API key)</div>
                    </div>
                    
                    <div class="endpoint">
                        <span class="method">GET</span>
                        <span class="url">/api/products/search</span>
                        <div class="description">Search products by criteria (requires API key)</div>
                    </div>
                    
                    <div class="endpoint">
                        <span class="method">GET</span>
                        <span class="url">/api/brand/overview</span>
                        <div class="description">Get brand overview and company information (requires API key)</div>
                    </div>
                </div>
                
                <div class="api-info">
                    <h2>🔑 Authentication</h2>
                    <p>This API uses API key authentication. Include your API key in the Authorization header:</p>
                    <div style="background: #1e293b; color: #60a5fa; padding: 15px; border-radius: 8px; font-family: 'Courier New', monospace; margin: 15px 0;">
                        Authorization: Bearer your_api_key_here
                    </div>
                    
                    <h2>🧪 Test API Keys</h2>
                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 8px 0; border-bottom: 1px solid #e2e8f0;">
                            <strong>Creator/Developer:</strong> <code>creator_dev_2024</code>
                        </li>
                        <li style="padding: 8px 0; border-bottom: 1px solid #e2e8f0;">
                            <strong>ATA Distributors:</strong> <code>ata_live_abc123</code>
                        </li>
                        <li style="padding: 8px 0; border-bottom: 1px solid #e2e8f0;">
                            <strong>NDA Distributors:</strong> <code>nda_live_xyz789</code>
                        </li>
                        <li style="padding: 8px 0;">
                            <strong>Test Client:</strong> <code>test_key_123</code>
                        </li>
                    </ul>
                    
                    <h2>📚 Documentation</h2>
                    <p>For detailed API documentation and examples, visit:</p>
                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 5px 0;">📖 <a href="/docs" style="color: #dc2626;">API Documentation</a></li>
                        <li style="padding: 5px 0;">🔧 <a href="https://github.com/JetSetEdit/tenacious-api" style="color: #dc2626;">GitHub Repository</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer">
                <p>© 2024 Tenacious Tapes API | Built with Laravel | Deployed on <a href="https://laravel.cloud">Laravel Cloud</a></p>
            </div>
        </div>
    </body>
</html>
