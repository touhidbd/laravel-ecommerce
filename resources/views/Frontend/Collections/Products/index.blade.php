@extends('layouts.app')
@section('title', $category->name.' | eCommerce Website')
@section('description', '')
@section('keywords', '')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/collections') }}">Collections</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product List Start -->
    <div class="product-view">
        <div class="container">
            <livewire:frontend.product.index :featuredproduct="$featured_product" :category="$category" :categories="$categories"  />
        </div>
    </div>
    <!-- Product List End -->
@endsection