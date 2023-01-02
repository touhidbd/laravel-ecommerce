<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Brands;
use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Categories;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $featured_product, $product_id, $quantityCount = 1, $productColorSelectedQuantity, $productColorId;
    
    public function mount($product, $category, $featured_product)
    {
        $this->product = $product;
        $this->category = $category;
        $this->featured_product = $featured_product;
    }

    public function colorSelected(int $productColorId)
    {
        $this->productColorId = $productColorId;
        $productcolorseletct = $this->product->productColor()->where('id', $productColorId)->first();
        $this->productColorSelectedQuantity = $productcolorseletct->quantity;

        if($this->productColorSelectedQuantity == 0)
        {
            $this->productColorSelectedQuantity = 'outOfStock';
        }
    }

    public function addwishlist(int $product_id)
    {
        $this->product_id = $product_id;

        if(Auth::check())
        {
            if(Product::where('id', $product_id)->where('status', '0')->exists())
            {
                if(Wishlist::where('user_id', Auth::user()->id)->where('product_id', $this->product_id)->exists())
                {
                    session()->flash('status', 'You already added this product in the wishlist!');
                    $this->dispatchBrowserEvent('message', [
                        'text'      => 'You already added this product in the wishlist!',
                        'type'      => 'warning',
                        'status'    => 409
                    ]);
                }
                else {
                    Wishlist::create([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $this->product_id
                    ]);    
                    
                    $this->emit('wishlistupdate');
                    session()->flash('status', 'Your wishlist added successfully!');
                    $this->dispatchBrowserEvent('message', [
                        'text'      => 'Your wishlist added successfully!',
                        'type'      => 'success',
                        'status'    => 200
                    ]);       
                }
            }
            else
            {
                session()->flash('status', 'Proudct not found!');
                $this->dispatchBrowserEvent('message', [
                    'text'      => 'Proudct not found!',
                    'type'      => 'error',
                    'status'    => 404
                ]);
            }
        }
        else
        {
            session()->flash('status', 'Please login to continue!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Please login to continue!',
                'type'      => 'notify',
                'status'    => 401
            ]);
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 1) {
            $this->quantityCount--;
        } else {
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Minimun quantity 1!',
                'type'      => 'error'
            ]);
        }
    }

    public function incrementQuantity($quantity)
    {
        if($this->quantityCount < $quantity) {
            $this->quantityCount++;
        } else {
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Maximum quantity '.$quantity.'!',
                'type'      => 'error'
            ]);
        }    
    }

    public function addToCart(int $product_id)
    {
        $product = Product::where('id', $product_id)->where('status', '0');

        // Check user is exists or not
        if(Auth::check())
        {
            // Check product is exists or not
            if($product->exists())
            {
                // Check product color quantity and added to cart
                if($product->first()->productColor()->count() > 1)
                {
                    // Check product color selected or not
                    if($this->productColorSelectedQuantity != NULL)
                    {
                        $productColor = $product->first()->productColor()->where('id', $this->productColorId)->first();

                        // Check product already added or not
                        if(Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->where('product_color_id', $this->productColorId)->exists())
                        {
                            session()->flash('status', 'Product already added!');
                            $this->dispatchBrowserEvent('message', [
                                'text'      => 'Product already added!',
                                'type'      => 'warning',
                                'status'    => 200
                            ]);
                        }
                        else
                        {
                            // Check product color quantity available or not
                            if($productColor->quantity > 0)
                            {
                                // Check product input quantity
                                if($productColor->quantity > $this->quantityCount) 
                                {
                                    // Insert Product with Color
                                    Cart::create([
                                        'user_id'           => Auth::user()->id,
                                        'product_id'        => $product_id,
                                        'product_color_id'  => $this->productColorId,
                                        'quantity'          => $this->quantityCount
                                    ]);

                                    session()->flash('status', 'Product added to cart successfully!');
                                    $this->dispatchBrowserEvent('message', [
                                        'text'      => 'Product added to cart successfully!',
                                        'type'      => 'success',
                                        'status'    => 200
                                    ]);
                                } 
                                else 
                                {
                                    session()->flash('status', 'Only '.$productColor->quantity.' quantity available!');
                                    $this->dispatchBrowserEvent('message', [
                                        'text'      => 'Only '.$productColor->quantity.' quantity available!',
                                        'type'      => 'error',
                                        'status'    => 404
                                    ]);
                                }
                            }
                            else
                            {
                                session()->flash('status', 'Out of stock!');
                                $this->dispatchBrowserEvent('message', [
                                    'text'      => 'Out of stock!',
                                    'type'      => 'error',
                                    'status'    => 404
                                ]);
                            }                            
                        }
                    }
                    else
                    {
                        session()->flash('status', 'Please select your product color!');
                        $this->dispatchBrowserEvent('message', [
                            'text'      => 'Please select your product color!',
                            'type'      => 'info',
                            'status'    => 404
                        ]);
                    }
                }
                else
                {
                    // Check product quantity
                    if($product->first()->quantity > 0) 
                    {
                        // Check product input quantity
                        if($product->first()->quantity > $this->quantityCount) 
                        {      
                            // Check product already added or not
                            if(Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->exists())
                            {
                                session()->flash('status', 'Product already added!');
                                $this->dispatchBrowserEvent('message', [
                                    'text'      => 'Product already added!',
                                    'type'      => 'warning',
                                    'status'    => 200
                                ]);
                            }
                            else
                            {
                                // Insert Product without Color
                                Cart::create([
                                    'user_id'           => Auth::user()->id,
                                    'product_id'        => $product_id,
                                    'quantity'          => $this->quantityCount
                                ]);

                                session()->flash('status', 'Product added to cart successfully!');
                                $this->dispatchBrowserEvent('message', [
                                    'text'      => 'Product added to cart successfully!',
                                    'type'      => 'success',
                                    'status'    => 200
                                ]);                                
                            }  
                        } 
                        else 
                        {
                            session()->flash('status', 'Only '.$product->first()->quantity.' quantity available!');
                            $this->dispatchBrowserEvent('message', [
                                'text'      => 'Only '.$product->first()->quantity.' quantity available!',
                                'type'      => 'error',
                                'status'    => 404
                            ]);
                        }
                    } 
                    else 
                    {
                        session()->flash('status', 'Out of stock!');
                        $this->dispatchBrowserEvent('message', [
                            'text'      => 'Out of stock!',
                            'type'      => 'error',
                            'status'    => 404
                        ]);
                    }                    
                }
            }
            else
            {
                session()->flash('status', 'Product not exists!');
                $this->dispatchBrowserEvent('message', [
                    'text'      => 'Product not exists!',
                    'type'      => 'error',
                    'status'    => 404
                ]);
            }
        }
        else
        {
            session()->flash('status', 'Please login to continue!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Please login to continue!',
                'type'      => 'notify',
                'status'    => 401
            ]);
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
