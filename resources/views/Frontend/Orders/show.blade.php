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
                <div class="col-md-7">
                    
                </div>
            </div>
        </div>
    </div>

@endsection

