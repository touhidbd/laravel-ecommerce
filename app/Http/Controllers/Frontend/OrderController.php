<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderItem;
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
        $orderitems = OrderItem::where('order_id', $order_id)->get();
        if($order)
        {
            return view('Frontend.orders.show', compact('order', 'orderitems'));
        }
        else
        {
            return redirect('/orders')->with('status', 'No order found!');
        }        
    }
}
