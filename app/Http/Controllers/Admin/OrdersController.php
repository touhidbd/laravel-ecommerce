<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderRequest;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $order = Order::when($request->date != null, function ($q) use ($request) {
                            return $q->whereDate('created_at', $request->date);
                        }, function($q) use ($todayDate) {
                            return $q->whereDate('created_at', $todayDate);
                        })
                        ->when($request->status != null, function ($q) use ($request) {
                            return $q->where('status', $request->status);
                        })
                        ->paginate(10);


        return view('admin.orders.index', compact('order'));
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
            return redirect()->back()->with('status', 'Somthing wrong!');
        }
    }

    public function viewInvoice(int $order_id)
    {
        $order = Order::findOrFail($order_id);
        $orderitems = OrderItem::where('order_id', $order_id)->get();
        return view('admin.invoice.generate-invoice', compact('order', 'orderitems'));
    }

    public function generateInvoice(int $order_id)
    {
        $order = Order::findOrFail($order_id);
        $orderitems = OrderItem::where('order_id', $order_id)->get();
        $data = [
            'order' => $order,
            'orderitems' => $orderitems
        ];
        $todayDate = Carbon::now()->format('d-m-Y');

        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        return $pdf->download('invoice-#'.$order->id.'_'.$todayDate.'.pdf');
    }
}
