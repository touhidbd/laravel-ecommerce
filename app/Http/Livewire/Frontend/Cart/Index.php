<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $carts;

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
                        'type'      => 'error',
                        'status'    => 401
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
    
    public function render()
    {
        $this->carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.cart.index', [
            'carts'  =>  $this->carts
        ]);
    }
}
