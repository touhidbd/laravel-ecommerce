@extends('layouts.admin')
@section('title', 'Order | Laravel Ecommerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="cart-title m-0">Order</h4>
                <div class="btn-list">
                    <button type="button" onclick="printJS('{{ url('/admin/invoice/'.$order->id.'/generate') }}')" class="btn btn-sm me-2 text-white btn-success">Print Invoice</button>
                    <a href="{{ url('/admin/invoice/'.$order->id) }}" target="_blank" class="btn btn-sm me-2 text-white btn-primary">View Invoice</a>
                    <a href="{{ url('/admin/invoice/'.$order->id.'/generate') }}" class="btn btn-sm me-2 text-white btn-danger">Download Invoice</a>
                    <a href="{{ url('/admin/invoice/'.$order->id.'/mail') }}" class="btn btn-sm me-2 text-white btn-warning">Send Email Invoice</a>
                    <a href="{{ url('/admin/orders') }}" class="btn btn-sm btn-info">Back</a>
                </div>

            </div>
            <div class="card-body">
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
                <form action="{{ url('admin/order/'.$order->id) }}" method="POST">
                    @csrf
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h3>Order Action:</h3>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="mb-3"><strong>Order Status</strong></label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                                <option value="1" @if($order->status == 1) selected @endif>Complated</option>
                                <option value="2" @if($order->status == 2) selected @endif>Shipping</option>
                                <option value="3" @if($order->status == 3) selected @endif>Cancelled</option>
                                <option value="4" @if($order->status == 4) selected @endif>Proccessing</option>
                                <option value="5" @if($order->status == 5) selected @endif>Refunded</option>
                            </select>
                            @error('status')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status_message" class="mb-3"><strong>Status Message</strong></label>
                            <textarea name="status_message" id="status_message" cols="30" rows="5" class="form-control">{{ $order->status_message }}</textarea>
                            @error('status_message')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success text-white">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
@endsection

@section('scripts')
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@if (session('status'))
<script>
    Swal.fire({
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        title: '{{ session("status") }}',
    })
</script>
@endif
@endsection
