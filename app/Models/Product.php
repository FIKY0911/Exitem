<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'stock',
        'is_popular',
        'colors',
        'category_id',
        'brand_id',
    ];

    protected $casts = [
        'colors' => 'array',
    ];

    public function category(): BelongsTo {
        // untuk mendapatkan data dari relasi belongsTo dengan table category dengan kaitan category_id
        return $this->belongsTo(Category::class, 'category_id'); 
    }

    public function brand(): BelongsTo {
        // untuk mendapatkan data dari relasi belongsTo dengan table brand dengan kaitan branch_id
        return $this->belongsTo(Brand::class, 'brand_id'); 
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function relatedProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id')
                    ->where('id', '!=', $this->id)
                    ->limit(4);
    }
}
