<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:generate-token {partner : The partner name (e.g., ATA_Distributors)} {--user-id=1 : The user ID to create the token for}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API token for a partner using Laravel Sanctum';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $partner = $this->argument('partner');
        $userId = $this->option('user-id');

        try {
            $user = User::findOrFail($userId);
            
            // Create the token using Sanctum
            $token = $user->createToken($partner)->plainTextToken;
            
            $this->info('✅ API Token generated successfully!');
            $this->newLine();
            $this->info('Partner: ' . $partner);
            $this->info('User: ' . $user->name . ' (ID: ' . $user->id . ')');
            $this->newLine();
            $this->warn('🔑 API Token (keep this secure):');
            $this->line($token);
            $this->newLine();
            $this->info('📋 Usage:');
            $this->line('Authorization: Bearer ' . $token);
            $this->newLine();
            $this->comment('💡 This token is cryptographically secure and hashed in the database.');
            $this->comment('   Store it securely and provide it to your partner.');
            
        } catch (\Exception $e) {
            $this->error('❌ Failed to generate token: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
} 