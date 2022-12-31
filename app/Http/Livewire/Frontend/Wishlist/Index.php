<?php

namespace App\Http\Livewire\Frontend\Wishlist;

use Livewire\Component;
use App\Models\Wishlist;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $wishlist_id;

    public function removeproduct($wishlist_id)
    {
        $this->wishlist_id = $wishlist_id;
        if(Auth::check())
        {
            $remove_wishlist = Wishlist::where('id', $wishlist_id)->first();
            if($remove_wishlist)
            {
                $remove_wishlist->delete();
                session()->flash('status', 'Product removed successfully!');
                $this->dispatchBrowserEvent('message', [
                    'text'      => 'Product removed successfully!',
                    'type'      => 'success',
                    'status'    => 200
                ]);
                return false;
            }
            else
            {
                session()->flash('status', 'Product not found!');
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
            session()->flash('status', 'Please login to continue!');
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
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->paginate(5);
        return view('livewire.frontend.wishlist.index', [
            'wishlist' => $wishlist,
        ]);
    }
}
