@extends('layouts.app')
@section('title', 'Thank you for your order! | eCommerce Laravel Website')
@section('description', '')
@section('keywords', '')

@section('content')    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Thank You</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <h5 class="alert alert-success">{{ session('status') }}</h5>
                @endif
                <div class="card py-5 text-center">
                    <h2>Thank you for your order!</h2>
                </div>
            </div>
        </div>
    </div>
@endsection