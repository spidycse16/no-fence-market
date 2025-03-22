<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'description',
        'sku',
        'seller_id',
        'catagory_id',
        'subcatagory_id',
        'store_id',
        'regular_price',
        'discounted_price',
        'tax_rate',
        'stock_quantity',
        'stock_status',
        'slug',
        'visibility',
        'meta_title',
        'meta_description',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /**
     * Get the seller that owns the product.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function catagory(): BelongsTo
    {
        return $this->belongsTo(Catagory::class);
    }

   
    public function subcatagory(): BelongsTo
    {
        return $this->belongsTo(Subcatagory::class);
    }

 
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}