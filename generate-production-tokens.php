<?php

// Production Token Generator
// This script generates tokens that will work with the production environment

// Production APP_KEY from your environment
$productionAppKey = 'base64:2hrpvOtNCFelYR2qbhHmuErVHaNN3Pg2iCU5LlPq0Vo=';

echo "=== Production Token Generator ===\n\n";

// Set the production APP_KEY
putenv("APP_KEY=$productionAppKey");

// Bootstrap Laravel
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Generate tokens for the required partners
$partners = ['test_key_123', 'creator_dev_2024'];

foreach ($partners as $partner) {
    echo "Generating token for: $partner\n";
    
    try {
        // Get the user (assuming user ID 1 exists)
        $user = \App\Models\User::find(1);
        
        if (!$user) {
            echo "❌ Error: No user found with ID 1\n";
            echo "Creating API Admin user...\n";
            
            $user = \App\Models\User::create([
                'name' => 'API Admin',
                'email' => 'admin@tenacioustapes.com',
                'password' => bcrypt('password'),
            ]);
            
            echo "✅ API Admin user created successfully!\n";
        }
        
        // Create the token using Sanctum
        $token = $user->createToken($partner)->plainTextToken;
        
        echo "✅ Token generated successfully!\n";
        echo "Partner: $partner\n";
        echo "User: {$user->name} (ID: {$user->id})\n";
        echo "🔑 API Token: $token\n";
        echo "📋 Usage: Authorization: Bearer $token\n";
        echo "\n";
        
    } catch (\Exception $e) {
        echo "❌ Failed to generate token for $partner: " . $e->getMessage() . "\n\n";
    }
}

echo "=== Token Generation Complete ===\n";
echo "\n";
echo "💡 These tokens are now ready to use with your production API!\n";
echo "🔒 Store them securely and use them in your API requests.\n"; 