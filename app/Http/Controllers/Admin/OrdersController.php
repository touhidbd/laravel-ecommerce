<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;

class OrdersController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function view(int $order_id)
    {
        $order = Order::where('id', $order_id)->first();        
        $orderitems = OrderItem::where('order_id', $order_id)->get();
        
        if($order)
        {
            return view('admin.orders.show', compact('order', 'orderitems'));
        }
        else
        {
            return redirect('admin/orders')->with('status', 'Order not found!');
        }
    }

    public function update(OrderRequest $request, int $order_id)
    {
        $validatedData = $request->validated();
        $order = Order::where('id', $order_id)->first();

        if($order)
        {
            $order->status = $validatedData['status'];
            $order->status_message = $validatedData['status_message'];

            $order->update();

            return redirect()->back()->with('status', 'Order Update successfully!');
        }
        else
        {
            // return redirect()->back()->with('status', 'Somthing wrong!');
        }
    }
}
