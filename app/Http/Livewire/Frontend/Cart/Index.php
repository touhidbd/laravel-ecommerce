<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $carts, $allTotalPrice = 0;

    public function incrementQuantity(int $cart_id)
    {
        $cart_data = Cart::where('id', $cart_id)->where('user_id', Auth::user()->id)->first();
        if($cart_data)
        {
            if($productColor = $cart_data->productColor()->where('id', $cart_data->product_color_id)->exists())
            {
                $productColor = $cart_data->productColor()->where('id', $cart_data->product_color_id)->first();
                if($productColor->quantity > $cart_data->quantity)
                {
                    $cart_data->increment('quantity');
                    session()->flash('status', 'Quantity Update!');
                    $this->dispatchBrowserEvent('message', [
                        'text'      => 'Quantity Update!',
                        'type'      => 'success',
                        'status'    => 200
                    ]);
                }
                else {
                    session()->flash('status', 'Only '.$cart_data->quantity.' quantity available!');
                    $this->dispatchBrowserEvent('message', [
                        'text'      => 'Only '.$cart_data->quantity.' quantity available!',
                        'type'      => 'error',
                        'status'    => 401
                    ]);
                }
            }
            else
            {
                if($cart_data->product->quantity > $cart_data->quantity)
                {
                    $cart_data->increment('quantity');
                    session()->flash('status', 'Quantity Update!');
                    $this->dispatchBrowserEvent('message', [
                        'text'      => 'Quantity Update!',
                        'type'      => 'success',
                        'status'    => 200
                    ]);
                }
            }
        }
        else {
            session()->flash('status', 'Something wrong!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Something wrong!',
                'type'      => 'error',
                'status'    => 404
            ]);

        }
    }

    public function decrementQuantity(int $cart_id)
    {
        $cart_data = Cart::where('id', $cart_id)->where('user_id', Auth::user()->id)->first();
        if($cart_data)
        {
            if($cart_data->quantity > 0)
            {
                $cart_data->decrement('quantity');
                session()->flash('status', 'Quantity Update!');
                $this->dispatchBrowserEvent('message', [
                    'text'      => 'Quantity Update!',
                    'type'      => 'success',
                    'status'    => 200
                ]);
            }
            else
            {
                session()->flash('status', 'Quantity not less then 0!');
                $this->dispatchBrowserEvent('message', [
                    'text'      => 'Quantity not less then 0!',
                    'type'      => 'error',
                    'status'    => 401
                ]);
            }
        }
        else {
            session()->flash('status', 'Something wrong!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Something wrong!',
                'type'      => 'error',
                'status'    => 404
            ]);

        }
    }

    public function removeproduct(int $product_id)
    {
        if(Auth::check())
        {
            $remove_cartitem = Cart::where('id', $product_id)->first();
            if($remove_cartitem)
            {
                $remove_cartitem->delete();
                session()->flash('status', 'Product removed successfully!');
                $this->emit('CartAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text'      => 'Product removed successfully!',
                    'type'      => 'success',
                    'status'    => 200
                ]);
            }
            else
            {
                session()->flash('status', 'Product not found!');
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
    
    public function render()
    {
        $this->carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.cart.index', [
            'carts'  =>  $this->carts
        ]);
    }
}
