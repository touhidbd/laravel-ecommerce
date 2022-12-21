<?php

namespace App\Models;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'orginal_price',
        'selling_price',
        'quantity',
        'trending',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description'
    ];
    
    use HasSlug;

    public function getSlugOptions():SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }

    public function brands()
    {
        return $this->belongsTo(Brands::class, 'brand', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
