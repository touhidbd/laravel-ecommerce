<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use App\Mail\InvoiceOrderMailable;
use Illuminate\Support\Facades\Mail;

class Index extends Component
{
    public $carts;

    public $name, $email, $phone, $address, $country, $city, $state, $zip, $status_message = NULL, $payment_mode = NULL, $payment_id = NULL;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'PayOnline'
    ];

    public function PayOnline($value)
    {
        $this->payment_id = $value;
        $this->payment_mode = 'Paid by Paypal';

        $onlineorder = $this->placeOrder();
        if($onlineorder)
        {
            Cart::where('user_id', auth()->user()->id)->delete();

            session()->flash('status', 'Order place successfully!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Order place successfully!',
                'type'      => 'success',
                'status'    => 200
            ]);
            return redirect()->to('thank-you');
        }
        else
        {
            session()->flash('status', 'Something went wrong!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Something went wrong!',
                'type'      => 'error',
                'status'    => 500
            ]);
        }
    }

    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'name'                  => 'required|string|max:121',
            'email'                 => 'required|email|max:121',
            'phone'                 => 'required|string|max:11',
            'address'               => 'required|string|max:500',
            'country'               => 'required|string|max:121',
            'city'                  => 'required|string|max:121',
            'state'                 => 'required|string|max:121',
            'zip'                   => 'required|string|max:121',
        ];
    }

    public function placeOrder()
    {
        $order = Order::create([
            'user_id'               => auth()->user()->id,
            'tracking_no'           => 'ecommerce_'.Str::random(10),
            'name'                  => $this->name,
            'email'                 => $this->email,
            'phone'                 => $this->phone,
            'address'               => $this->address,
            'country'               => $this->country,
            'city'                  => $this->city,
            'state'                 => $this->state,
            'zip'                   => $this->zip,
            'status'                => '0',
            'status_message'        => $this->status_message,
            'payment_mode'          => $this->payment_mode,
            'payment_id'            => $this->payment_id,
        ]);

        $cart_list = Cart::where('user_id', auth()->user()->id)->get();

        foreach($cart_list as $cartItem)
        {            
            if($cartItem->product->selling_price) {
                $price = $cartItem->product->selling_price;
            } else {
                $price = $cartItem->product->orginal_price;
            }

            $orderItems = OrderItem::create([
                'order_id'              => $order->id,
                'product_id'            => $cartItem->product_id,
                'product_color_id'      => $cartItem->product_color_id,
                'quantity'              => $cartItem->quantity,
                'price'                 => $price * $cartItem->quantity
            ]);

            if($cartItem->product_color_id != NULL)
            {
                $cartItem->productColor->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            }
            else
            {
                $cartItem->product->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }

        return $order;
    }

    public function codOrder()
    {
        $this->validate();
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder)
        {
            Cart::where('user_id', auth()->user()->id)->delete();

            session()->flash('status', 'Order place successfully!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Order place successfully!',
                'type'      => 'success',
                'status'    => 200
            ]);
            return redirect()->to('thank-you');
        }
        else
        {
            session()->flash('status', 'Something went wrong!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Something went wrong!',
                'type'      => 'error',
                'status'    => 500
            ]);
        }
    }

    public function render()
    {
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        return view('livewire.frontend.checkout.index', [
            'carts' => $this->carts
        ]);
    }
}
