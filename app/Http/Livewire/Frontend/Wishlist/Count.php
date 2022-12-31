<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Count extends Component
{
    public $wishlistcount;
    protected $listeners = ['wishlistupdate' => 'checkwishlistcount'];

    public function checkwishlistcount()
    {
        if(Auth::check())
        {
            return $this->wishlistcount = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        else
        {
            return $this->wishlistcount = 0;
        }
    }

    public function render()
    {
        $this->wishlistcount = $this->checkwishlistcount();
        return view('livewire.frontend.wishlist.count', [
            'wishlistcount'  => $this->wishlistcount
        ]);
    }
}
