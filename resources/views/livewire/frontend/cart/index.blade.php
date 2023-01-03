<div>
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/collections') }}">Collections</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    
    
    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @foreach ($carts as $cart)
                                    @if ($cart->product)
                                        @php
                                            if($cart->product->selling_price){
                                                $price = $cart->product->selling_price;
                                            } else {
                                                $price = $cart->product->orginal_price;
                                            }

                                            $total_price = $price*$cart->quantity;
                                        @endphp
                                        <tr>
                                            <td>
                                                <a href="{{ url('collections/'.$cart->product->category->slug.'/'.$cart->product->slug) }}">
                                                    @if ($cart->product->productImages[0])
                                                        <img src="{{ url($cart->product->productImages[0]->image) }}" alt="{{ $cart->product->name }}">
                                                    @endif                                                    
                                                </a>
                                            </td>
                                            <td><a href="{{ url('collections/'.$cart->product->category->slug.'/'.$cart->product->slug) }}">{{ $cart->product->name }} @if ($cart->productColor)({{ $cart->productColor->color->name }})@endif</a></td>
                                            <td>${{ $price }}</td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus" wire:loading.attr="disabled" wire:click="decrementQuantity({{ $cart->id }})"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="{{ $cart->quantity }}">
                                                    <button class="btn-plus" wire:loading.attr="disabled" wire:click="incrementQuantity({{ $cart->id }})"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td>${{ $total_price }}</td>
                                            <td><button><i class="fa fa-trash"></i></button></td>
                                        </tr>                                      
                                    @endif
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="coupon">
                        <input type="text" placeholder="Coupon Code">
                        <button>Apply Code</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cart-summary">
                        <div class="cart-content">
                            <h3>Cart Summary</h3>
                            <p>Sub Total<span>$22</span></p>
                            <p>Shipping Cost<span>$1</span></p>
                            <h4>Grand Total<span>$23</span></h4>
                        </div>
                        <div class="cart-btn">
                            <button>Update Cart</button>
                            <button>Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
</div>
