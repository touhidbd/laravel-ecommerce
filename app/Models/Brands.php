<?php

namespace App\Models;

use App\Models\Product;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brands extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
    ];
    
    use HasSlug;

    public function getSlugOptions():SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand', 'id');
    }
}
