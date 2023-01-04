<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class Index extends Component
{
    public $carts;

    public $name, $email, $phone, $address, $country, $city, $state, $zip, $status_message = NULL, $payment_mode = NULL, $payment_id = NULL;

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
            
            // 'shipping_different'    => 'nullable|string|max:121',
            // 'different_name'        => 'nullable|string|max:121',
            // 'different_email'       => 'nullable|string|max:121',
            // 'different_phone'       => 'nullable|string|max:121',
            // 'different_address'     => 'nullable|string|max:121',
            // 'different_country'     => 'nullable|string|max:121',
            // 'different_city'        => 'nullable|string|max:121',
            // 'different_state'       => 'nullable|string|max:121',
            // 'different_zip'         => 'nullable|string|max:121'
        ];
    }

    public function placeOrder()
    {
        $this->validate();

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

            // 'shipping_different'    => $this->shipping_different == true ? '1':'0',
            // 'different_name'        => $this->different_name,
            // 'different_email'       => $this->different_email,
            // 'different_phone'       => $this->different_phone,
            // 'different_address'     => $this->different_address,
            // 'different_country'     => $this->different_country,
            // 'different_city'        => $this->different_city,
            // 'different_state'       => $this->different_state,
            // 'different_zip'         => $this->different_zip
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
            return redirect()->to('/thank-you');
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
        $this->phone = auth()->user()->phone;
        $this->address = auth()->user()->address;
        $this->country = auth()->user()->country;
        $this->city = auth()->user()->city;
        $this->state = auth()->user()->state;
        $this->zip = auth()->user()->zip;
        return view('livewire.frontend.checkout.index', [
            'carts' => $this->carts
        ]);
    }
}
