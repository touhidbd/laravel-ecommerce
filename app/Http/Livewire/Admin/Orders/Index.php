<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    
    public function render()
    {
        $today = Carbon::now();
        $orders = Order::whereDate('created_at', $today)->orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.orders.index', [
            'orders'    => $orders
        ]);
    }
}
