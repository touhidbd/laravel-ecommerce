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
            <div class="row">

                <div class="col-md-9">
                    <livewire:frontend.product.index :products="$products" />
                </div>                

                <div class="col-md-3">
                    @if ($categories->count() > 0)                    
                    <div class="sidebar-widget category">
                        <h2 class="title">Category</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ url('collections/'.$category->slug) }}">{{ $category->name }}</a><span>({{ $category->products->count() }})</span></li>  
                            @endforeach
                        </ul>
                    </div>
                    @endif                    
                    <div class="sidebar-widget image">
                        <h2 class="title">Featured Product</h2>
                        <a href="{{ url('collections/'.$featured_product->category->slug.'/'.$featured_product->slug) }}">
                            <img src="{{ asset($featured_product->productImages[0]->image) }}" alt="{{ $featured_product->name }}">
                        </a>
                    </div>
                    @if ($brands->count() > 0)                    
                    <div class="sidebar-widget brands">
                        <h2 class="title">Our Brands</h2>
                        <ul>
                            @foreach ($brands as $brand)
                                <li><a href="#">{{ $brand->name }}</a><span>({{ $brand->products->count() }})</span></li>  
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Product List End -->
@endsection