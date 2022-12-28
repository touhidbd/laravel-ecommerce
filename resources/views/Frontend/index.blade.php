@extends('layouts.app')
@section('title', 'Home | eCommerce Laravel Website')
@section('description', '')
@section('keywords', '')

@section('content')

    @if ($sliders->count() > 0) 
    <!-- Main Slider Start -->
    <div class="home-slider">
        <div class="main-slider">
            @foreach ($sliders as $slider)    
            <div class="main-slider-item">
                <img src="{{ asset('uploads/slider/'. $slider->image) }}" class="d-block w-100" alt="{{  $slider->title }}">
            </div>         
            @endforeach
        </div>
    </div>
    <!-- Main Slider End -->
    @endif
    
    
    <!-- Feature Start-->
    <div class="feature">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-shield"></i>
                        <h2>Trusted Shopping</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-shopping-bag"></i>
                        <h2>Quality Product</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-truck"></i>
                        <h2>Worldwide Delivery</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-phone"></i>
                        <h2>Telephone Support</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End-->
    

    <!-- Category Start-->
    <div class="category">
        <div class="container-fluid">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-4">
                        <div class="category-img">
                            <img src="{{ asset('uploads/category/'.$category->image) }}" />
                            <a class="category-name" href="{{ url('collections/'.$category->slug) }}">
                                <h2>{{ $category->name }}</h2>
                            </a>
                        </div>
                    </div>                    
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category End-->
    
    
    <!-- Featured Product Start -->
    <div class="featured-product">
        <div class="container">
            <div class="section-header">
                <h3>Featured Product</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
            <div class="row align-items-center product-slider product-slider-4">

                @foreach ($products->where('trending', '1') as $product)
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                                    <img src="{{ asset($product->productImages[0]->image) }}" alt="{{ $product->name }}">
                                    @if ($product->quantity > 0)
                                        <span class="stock bg-success">In Stock</span>
                                    @else
                                        <span class="stock bg-danger">Out of Stock</span>
                                    @endif    
                                </a>
                                <div class="product-action">
                                    @if ($product->quantity > 0)
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    @endif
                                    <a href="#"><i class="fa fa-heart"></i></a>
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
                @endforeach
                
            </div>
        </div>
    </div>
    <!-- Featured Product End -->
    
    
    <!-- Newsletter Start -->
    <div class="newsletter">
        <div class="container">
            <div class="section-header">
                <h3>Subscribe Our Newsletter</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
            <div class="form">
                <input type="email" value="Your email here">
                <button>Submit</button>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->
    
    
    <!-- Recent Product Start -->
    <div class="recent-product">
        <div class="container">
            <div class="section-header">
                <h3>Recent Product</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                @foreach ($products as $product)
                    <div class="col-lg-3">
                        <div class="product-item">
                            <div class="product-image">
                                <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                                    <img src="{{ asset($product->productImages[0]->image) }}" alt="{{ $product->name }}">
                                    @if ($product->quantity > 0)
                                        <span class="stock bg-success">In Stock</span>
                                    @else
                                        <span class="stock bg-danger">Out of Stock</span>
                                    @endif    
                                </a>
                                <div class="product-action">
                                    @if ($product->quantity > 0)
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    @endif
                                    <a href="#"><i class="fa fa-heart"></i></a>
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
                @endforeach
            </div>
        </div>
    </div>
    <!-- Recent Product End -->
    
    
    <!-- Brand Start -->
    <div class="brand">
        <div class="container">
            <div class="section-header">
                <h3>Our Brands</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                </p>
            </div>
            <div class="brand-slider">
                @foreach ($brands as $brand)
                <div class="brand-item"><img src="{{ asset('storage/brand/'.$brand->image) }}" alt="{{ $brand->name }}"></div>
                @endforeach                
            </div>
        </div>
    </div>
    <!-- Brand End -->

@endsection