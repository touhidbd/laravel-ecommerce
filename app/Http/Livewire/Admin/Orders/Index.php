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

    public $filter, $date, $status, $search, $payment;

    protected $queryString = [
        'date',
        'status',
        'search',
        'payment'
    ];
    
    public function render()
    {
        $orders = Order::when($this->status, function($q){
                            $q->whereIn('status', [$this->status]);
                        })
                        ->when($this->date, function($q){
                            $q->whereDate('created_at', $this->date);
                        })
                        ->when($this->payment, function($q){
                            $q->when($this->payment == 'cash-on-delivery', function($q2){
                                $q2->where('payment_mode', 'Cash on Delivery');
                            })
                            ->when($this->payment == 'paid-by-paypal', function($q2){
                                $q2->where('payment_mode', 'Paid by Paypal');
                            });
                        })
                        ->when($this->search, function($q){
                            $q->where('tracking_no', 'LIKE', '%'.$this->search.'%');
                        })
                        ->paginate(10);
        return view('livewire.admin.orders.index', [
            'orders'    => $orders
        ]);
    }
}
