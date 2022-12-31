<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Loop extends Component
{
    public $products;

    public function mount($products)
    {
        $this->products = $products;
    }

    public function addproductwishlist($product_id)
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
                    return false;
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
                    return false;       
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
                return false; 
            }
        }
        else
        {
            session()->flash('status', 'Please login to add this product in your wishlist!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Please login to continue!',
                'type'      => 'notify',
                'status'    => 401
            ]);
            return false;
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.loop', [
            'products'  => $this->products
        ]);
    }
}
