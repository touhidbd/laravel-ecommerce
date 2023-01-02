<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $cartcount;

    protected $listeners = ['CartAddedUpdated' => 'cartcount'];

    public function cartcount()
    {
        if(Auth::check())
        {
            return $this->cartcount = Cart::where('user_id', Auth::user()->id)->count();
        }
        else
        {
            return $this->cartcount = 0;
        }
    }

    public function render()
    {
        $this->cartcount = $this->cartcount();
        return view('livewire.frontend.cart.cart-count', [
            'cartcount'  =>  $this->cartcount
        ]);
    }
}
