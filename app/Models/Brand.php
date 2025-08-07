<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'overview',
        'company_description',
        'website',
        'email',
        'phone',
        'address',
        'logo_url',
        'social_media',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'social_media' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the products for the brand.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
