<div>
    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/collections') }}">Collections</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/collections/'.$category->slug) }}">{{ $category->name }}</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->



    <!-- Product Detail Start -->
    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row align-items-center product-detail-top">
                        <div class="col-md-5">
                            <div class="product-images">
                                <div class="product-slider-single">
                                    @foreach ($product->productImages as $image)
                                    <img src="{{ asset($image->image) }}" alt="{{ $product->name }}"> 
                                    @endforeach                                
                                </div>
                                @if ($product->quantity > 0)
                                    <span class="stock bg-success">In Stock</span>
                                @else
                                    <span class="stock bg-danger">Out of Stock</span>
                                @endif     
                                <span class="brand bg-warning">Brand: <strong>{{ $product->brands->name }}</strong></span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title"><h2>{{ $product->name }}</h2></div>
                                <div class="ratting">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                @if ($product->selling_price)
                                <div class="price">${{ $product->selling_price }} <span>${{ $product->orginal_price }}</span></div>
                                @else
                                <div class="price">${{ $product->orginal_price }}</div>
                                @endif
                                
                                <div class="details">
                                    {!! $product->small_description !!}
                                </div>

                                <div class="colors">
                                    @if ($product->productColor)
                                        @foreach ($product->productColor as $color)
                                            <label><input type="radio" name="colorSelection" value="{{ $color->id }}"> {{ $color->color->name }}</label>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="quantity">
                                    <h4>Quantity:</h4>
                                    <div class="qty">
                                        <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="1">
                                        <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="action">
                                    @if ($product->quantity > 0)
                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                    @endif
                                    <button wire:click="addwishlist({{ $product->id }})" type="button">
                                        <span wire:loading.remove><i class="fa fa-heart"></i></span>
                                        <span wire:loading wire:target="addwishlist"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row product-detail-bottom">
                        <div class="col-lg-12">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#reviews">Reviews (1)</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="description" class="container tab-pane active"><br>
                                    <h4>Product description</h4>
                                    {!! $product->description !!}
                                </div>
                                <div id="reviews" class="container tab-pane fade"><br>
                                    <div class="reviews-submitted">
                                        <div class="reviewer">Phasellus Gravida - <span>01 Jan 2020</span></div>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <p>
                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
                                        </p>
                                    </div>
                                    <div class="reviews-submit">
                                        <h4>Give your Review:</h4>
                                        <div class="ratting">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="row form">
                                            <div class="col-sm-6">
                                                <input type="text" placeholder="Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" placeholder="Email">
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea placeholder="Review"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <button>Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    @if ($products->count() > 0)
                        <div class="container">
                            <div class="section-header">
                                <h3>Related Products</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
                                </p>
                            </div>
                        </div>
                        <div class="row align-items-center product-slider product-slider-2">
                            @foreach ($products as $product)
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
                    @endif

                </div>
                
                <div class="col-lg-3">
            
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
                    <div class="sidebar-widget brands mb-5">
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
    <!-- Product Detail End -->
</div>