<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sku',
        'description',
        'category',
        'type',
        'width',
        'length',
        'color',
        'price',
        'currency',
        'image_url',
        'specifications',
        'features',
        'applications',
        'is_featured',
        'is_active',
        'stock_quantity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'specifications' => 'array',
        'features' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured products.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
