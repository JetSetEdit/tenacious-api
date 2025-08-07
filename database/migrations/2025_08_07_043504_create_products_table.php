<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->text('description');
            $table->string('category');
            $table->string('type'); // gaffer, cloth, etc.
            $table->string('width')->nullable();
            $table->string('length')->nullable();
            $table->string('color')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->string('image_url')->nullable();
            $table->json('specifications')->nullable();
            $table->json('features')->nullable();
            $table->text('applications')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('stock_quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
