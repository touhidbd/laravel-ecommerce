<?php

namespace App\Http\Livewire\Frontend\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    
    public function render()
    {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.frontend.orders.index', [
            'orders' => $orders
        ]);
    }
}
