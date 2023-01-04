<div>    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/cart') }}">Cart</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    
    
    <!-- Checkout Start -->
    <div class="checkout">
        <div class="container"> 
            <div class="row">
                @if ($carts->count() > 0)
                <div class="col-md-7">
                    <div class="billing-address">
                        <h2>Billing Address</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input wire:model.defer="name" class="form-control" type="text" placeholder="Name">
                                @error('name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input wire:model.defer="email" class="form-control" type="text" placeholder="E-mail">
                                @error('email')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Phone</label>
                                <input wire:model.defer="phone" class="form-control" type="text" placeholder="Phone">
                                @error('phone')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label>Address</label>
                                <input wire:model.defer="address" class="form-control" type="text" placeholder="Address">
                                @error('address')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <select wire:model.defer="country" class="custom-select">
                                    <option>-- Select Option --</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="United States">United States</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                </select>
                                @error('country')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>City</label>
                                <input wire:model.defer="city" class="form-control" type="text" placeholder="City">
                                @error('city')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>State</label>
                                <input wire:model.defer="state" class="form-control" type="text" placeholder="State">
                                @error('state')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>ZIP Code</label>
                                <input wire:model.defer="zip" class="form-control" type="text" placeholder="ZIP Code">
                                @error('email')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input wire:model.defer="shipping_different" type="checkbox" class="custom-control-input" id="shipto">
                                    <label class="custom-control-label" for="shipto">Ship to different address</label>
                                </div>
                                @error('email')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="shipping-address">
                        <h2>Shipping Address</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input wire:model="different_name" class="form-control" type="text" placeholder="Name">
                                @error('different_name')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input wire:model="different_email" class="form-control" type="text" placeholder="E-mail">
                                @error('different_email')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Phone</label>
                                <input wire:model="different_phone" class="form-control" type="text" placeholder="Phone">
                                @error('different_phone')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label>Address</label>
                                <input wire:model="different_address" class="form-control" type="text" placeholder="Address">
                                @error('different_address')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Country</label>
                                <select wire:model="different_country" class="custom-select">
                                    <option>-- Select Option --</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="United States">United States</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                </select>
                                @error('different_country')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>City</label>
                                <input wire:model="different_city" class="form-control" type="text" placeholder="City">
                                @error('different_city')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>State</label>
                                <input wire:model="different_state" class="form-control" type="text" placeholder="State">
                                @error('different_state')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>ZIP Code</label>
                                <input wire:model="different_zip" class="form-control" type="text" placeholder="ZIP Code">
                                @error('different_zip')
                                    <p class="small text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="checkout-summary">
                        <h2>Cart Total</h2>
                        <div class="checkout-content">
                            <h3>Products</h3>
                            @php
                                $sub_total_amount = 0;
                                $shipping_cost = 1;
                            @endphp
                            @foreach ($carts as $cart)
                                @php
                                    if($cart->product->selling_price) {
                                        $price = $cart->product->selling_price;
                                    } else {
                                        $price = $cart->product->orginal_price;
                                    }
                                    $sub_total_amount += $price * $cart->quantity;
                                @endphp
                                <p>{{ $cart->product->name }} @if ($cart->productColor)({{ $cart->productColor->color->name }})@endif<span>${{ $price }} x {{ $cart->quantity }} = ${{ $price * $cart->quantity}}</span></p>
                            @endforeach
                            
                            {{-- <p class="sub-total">Sub Total<span>${{ $sub_total_amount }}</span></p> --}}
                            {{-- <p class="ship-cost">Shipping Cost<span>${{ $shipping_cost }}</span></p> --}}
                            <h4>Grand Total<span>${{ $sub_total_amount }}</span></h4>
                        </div>
                    </div>
                    
                    <div class="checkout-payment">
                        <h2>Payment Methods</h2>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Cash On Delivery</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Online Payment</button>
                            </li>
                        </ul>
                        <div class="tab-content border border-top-0" id="myTabContent">
                            <div class="tab-pane fade p-2 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="checkout-button">
                                    <button wire:click="codOrder" class="btn btn-success w-100 mt-0">
                                        <span wire:loading.remove wire:target="codOrder">Place Order (Cash on Delivery)</span>
                                        <span wire:loading wire:target="codOrder"><i class="fa fa-spinner fa-pulse fa-fw"></i> Proccessing</span>
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade p-2 border-top-0" id="profile" role="tabpanel" aria-labelledby="profile-tab">                         
                                <div class="checkout-button">
                                    <button class="btn btn-warning w-100 mt-0">Make Payment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                @else
                @php
                    return redirect('/');
                @endphp                 
                @endif
            </div>
        </div>
    </div>
    <!-- Checkout End -->
</div>
