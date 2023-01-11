@extends('layouts.app')
@section('title', 'New Arrivals | eCommerce Laravel Website')
@section('description', '')
@section('keywords', '')

@section('content')    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/collections') }}">Collections</a></li>
                <li class="breadcrumb-item active">New Arrivals</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Featured Product Start -->
    <div class="featured-product">
        <div class="container">
            <div class="section-header">
                <h3>New Arrivals Product</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
        </div>
    </div>
    <!-- Featured Product End -->

    <!-- Product List Start -->
    <div class="product-view">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        @forelse ($products as $product)
                            <div class="col-lg-4">
                                <div class="product-item">
                                    <div class="product-image">
                                        <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                                            <img src="{{ asset($product->productImages[0]->image) }}" alt="{{ $product->name }}">
                                            @if ($product->quantity > 0)
                                                <span class="stock bg-success">In Stock</span>
                                            @else
                                                <span class="stock bg-danger">Out of Stock</span>
                                            @endif     
                                            <span class="brand bg-warning">Brand: <strong>{{ $product->brands->name }}</strong></span>                                           
                                        </a>
                                        <div class="product-action">
                                            @if ($product->quantity > 0)
                                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                                            @endif                                          
                                            <button wire:click="addproductwishlist({{ $product->id }})" type="button">
                                                <span wire:loading.remove wire:target="addproductwishlist({{ $product->id }})"><i class="fa fa-heart"></i></span>
                                                <span wire:loading wire:target="addproductwishlist({{ $product->id }})"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                                            </button>
                                            <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>                                    
                                    <div class="product-content">
                                        <div class="title"><a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">{{ $product->name }}</a></div>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="price">
                                            @if ($product->selling_price)
                                            ${{ $product->selling_price }} <span>${{ $product->orginal_price }}</span>
                                            @else
                                            ${{ $product->orginal_price }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>              
                        @empty
                            <h5 class="text-center">No product found!</h5>
                        @endforelse  
                    </div>        
                    
                    <div class="col-lg-12 custom-pagination">
                        {{ $products->links() }}
                    </div>
                </div>                
            
                <div class="col-md-3">   
                    
                    @if ($categories->count() > 0)                    
                    <div class="sidebar-widget category">
                        <h2 class="title">Category</h2>
                        <ul>
                            @foreach ($categories as $category)
                                @if ($category->products->count() > 0)
                                    <li>
                                        <a href="{{ url('collections/'.$category->slug) }}">{{ $category->name }}</a>
                                        <span>({{ $category->products->count() }})</span>
                                    </li>  
                                @endif
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
                                @if ($brand->products->count() > 0)
                                    <li>
                                        {{ $brand->name }}
                                        <span>({{ $brand->products->count() }})</span>
                                    </li>  
                                @endif
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