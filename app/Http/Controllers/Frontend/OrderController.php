<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('Frontend.orders.index');
    }

    public function show(int $order_id)
    {
        $order = Order::where('user_id', auth()->user()->id)->where('id', $order_id)->first();
        if($order)
        {
            return view('Frontend.orders.show', compact('order'));
        }
        else
        {
            return redirect('/orders')->with('status', 'No order found!');
        }        
    }
}
