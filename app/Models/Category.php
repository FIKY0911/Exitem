<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    // Mass assignable attributes (user bisa modif data" berikut)
    protected $fillable = [
        'name',  // atribut lain yg gk disebutkan diurus oleh laravel
        'slug',
        'icon',
    ];

    public function products(): HasMany {
        // untuk mendapatkan data dari relasi hasMany dengan table product
        return $this->hasMany(Product::class); 
    }
    
    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value); // otomatis buat slug dari name
    }

}
