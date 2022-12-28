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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="product-search">
                                        <input type="email" value="Search">
                                        <button><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="product-short">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Product short by</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Newest</a>
                                                <a href="#" class="dropdown-item">Popular</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @forelse ($products as $product)
                            @if ($product->status == '0')  
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
                            @endif               
                        @empty
                            <h5 class="text-center">No product found!</h5>
                        @endforelse                                                
                    </div>
                    
                    <div class="col-lg-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
                
                
                <div class="col-md-3">
                    <div class="sidebar-widget category">
                        <h2 class="title">Category</h2>
                        <ul>
                            <li><a href="#">Lorem Ipsum</a><span>(83)</span></li>
                            <li><a href="#">Cras sagittis</a><span>(198)</span></li>
                            <li><a href="#">Vivamus</a><span>(95)</span></li>
                            <li><a href="#">Fusce vitae</a><span>(48)</span></li>
                            <li><a href="#">Vestibulum</a><span>(210)</span></li>
                            <li><a href="#">Proin phar</a><span>(78)</span></li>
                        </ul>
                    </div>
                    
                    <div class="sidebar-widget image">
                        <h2 class="title">Featured Product</h2>
                        <a href="#">
                            <img src="{{ asset('assets/img/category-1.jpg') }}" alt="Image">
                        </a>
                    </div>
                    
                    <div class="sidebar-widget brands">
                        <h2 class="title">Our Brands</h2>
                        <ul>
                            <li><a href="#">Nulla </a><span>(45)</span></li>
                            <li><a href="#">Curabitur </a><span>(34)</span></li>
                            <li><a href="#">Nunc </a><span>(67)</span></li>
                            <li><a href="#">Ullamcorper</a><span>(74)</span></li>
                            <li><a href="#">Fusce </a><span>(89)</span></li>
                            <li><a href="#">Sagittis</a><span>(28)</span></li>
                        </ul>
                    </div>
                    
                    <div class="sidebar-widget tag">
                        <h2 class="title">Tags Cloud</h2>
                        <a href="#">Lorem ipsum</a>
                        <a href="#">Vivamus</a>
                        <a href="#">Phasellus</a>
                        <a href="#">pulvinar</a>
                        <a href="#">Curabitur</a>
                        <a href="#">Fusce</a>
                        <a href="#">Sem quis</a>
                        <a href="#">Mollis metus</a>
                        <a href="#">Sit amet</a>
                        <a href="#">Vel posuere</a>
                        <a href="#">orci luctus</a>
                        <a href="#">Nam lorem</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product List End -->
@endsection