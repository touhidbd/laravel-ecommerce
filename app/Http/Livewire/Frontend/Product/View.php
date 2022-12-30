<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Brands;
use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $featured_product, $product_id;

    public function mount($product, $category, $featured_product)
    {
        $this->product = $product;
        $this->category = $category;
        $this->featured_product = $featured_product;
    }

    public function addwishlist($product_id)
    {
        $this->product_id = $product_id;

        if(Auth::check())
        {
            if(Product::where('id', $product_id)->where('status', '0')->exists())
            {
                if(Wishlist::where('user_id', Auth::user()->id)->where('product_id', $this->product_id)->exists())
                {
                    session()->flash('status', 'You already added this product in the wishlist!');
                    return false;
                }
                else {
                    Wishlist::create([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $this->product_id
                    ]);    
                    session()->flash('status', 'Your wishlist added successfully!');
                    return false;       
                }
            }
            else
            {
                session()->flash('status', 'Proudct not found!');
                return false; 
            }
        }
        else
        {
            session()->flash('status', 'Please login to add this product in your wishlist!');
            return false;
        }
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
