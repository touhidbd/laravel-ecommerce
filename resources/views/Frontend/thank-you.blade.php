@extends('layouts.app')
@section('title', 'Thank you for your order! | eCommerce Laravel Website')
@section('description', '')
@section('keywords', '')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card py-5 text-center">
                    @if (session('status'))
                        <h5 class="alert alert-success">{{ session('status') }}</h5>
                    @endif
                    <h2>Thank you for your order!</h2>
                </div>
            </div>
        </div>
    </div>
@endsection