@extends('layouts.app')
@section('title', 'My Order Details | eCommerce')

@section('content')

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/orders') }}">My Orders</a></li>
                <li class="breadcrumb-item active">My Order Details</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="cart-page">
        <div class="container">
            <div class="row">              
                <div class="col-md-6">
                    <div class="cart-summary">
                        <div class="cart-content">
                            <h3>User Details:</h3>
                            <hr>
                            <ul>
                                <li>Name: <strong>{{ $order->name }}</strong></li>
                                <li>Email: <strong>{{ $order->email }}</strong></li>
                                <li>Phone: <strong>{{ $order->phone }}</strong></li>
                                <li>Address: <strong>{{ $order->address }}</strong></li>
                                <li>Country: <strong>{{ $order->country }}</strong></li>
                                <li>City: <strong>{{ $order->city }}</strong></li>
                                <li>State: <strong>{{ $order->state }}</strong></li>
                                <li>Zip Code: <strong>{{ $order->zip }}</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="cart-summary">
                        <div class="cart-content">
                            <h3>Order Details:</h3>
                            <hr>
                            <ul>
                                <li>Order ID: <strong>{{ $order->id }}</strong></li>
                                <li>Tracking No: <strong>{{ $order->tracking_no }}</strong></li>
                                <li>Order Created Date: <strong>{{ $order->created_at->format('d-m-Y') }}</strong></li>
                                <li>Payment Mode: <strong>{{ $order->payment_mode }}</strong></li>
                                <li>Order Status: 
                                    <strong>
                                        @if ($order->status == 0)
                                        <span class="badge badge-primary">Pending</span>
                                        @elseif ($order->status == 1)
                                        <span class="badge badge-success">Complated</span>
                                        @elseif ($order->status == 2)
                                        <span class="badge badge-warning">Shipping</span>
                                        @elseif ($order->status == 3)
                                        <span class="badge badge-danger">Cancelled</span>
                                        @elseif ($order->status == 4)
                                        <span class="badge badge-info">Proccessing</span>
                                        @elseif ($order->status == 5)
                                        <span class="badge badge-dark">Refunded</span>
                                        @endif
                                    </strong>
                                </li>
                                <li>Status Message: <strong>{{ $order->status_message }}</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <h3>Order Items:</h3>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-left">Name</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $allitemsprice = 0;
                                @endphp
                                @foreach ($orderitems as $orderitem)                                
                                @php
                                    if($orderitem->product->selling_price){
                                        $price = $orderitem->product->selling_price;
                                    } else {
                                        $price = $orderitem->product->orginal_price;
                                    }

                                    $total_price = $price*$orderitem->quantity;
                                    $allitemsprice += $total_price;
                                @endphp
                                <tr>
                                    <td class="text-left">{{ $orderitem->product->name }} @if ($orderitem->productColor)({{ $orderitem->productColor->color->name }})@endif</td>
                                    <td><img src="{{ asset($orderitem->product->productImages[0]->image) }}" alt=""></td>
                                    <td>{{ $orderitem->quantity }}</td>
                                    <td>${{$price}}x{{$orderitem->quantity}} = ${{ $total_price }}</td>
                                </tr>                                    
                                @endforeach
                            </tbody>
                            <tbody>
                                <tr>
                                    <td class="text-left" colspan="3"><strong>Total Price:</strong></td>
                                    <td><strong>${{ $allitemsprice }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

