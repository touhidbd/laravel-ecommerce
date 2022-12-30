<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Brands;
use App\Models\Product;
use Livewire\Component;
use App\Models\Categories;

class View extends Component
{
    public $category, $product, $featured_product;

    public function mount($product, $category, $featured_product)
    {
        $this->product = $product;
        $this->category = $category;
        $this->featured_product = $featured_product;
    }

    public function render()
    {
        $categories = Categories::where('status', '0')->limit(6)->get();
        $brands = Brands::where('status', '0')->limit(6)->get();
        $products = Product::where('category_id', $this->category->id)->where('id', '!=', $this->product->id)->where('status', '0')->get();
        
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category,
            'featured_product' => $this->featured_product,
            'brands' => $brands,
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
