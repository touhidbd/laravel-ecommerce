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
                        <div class="col-md-5" wire:ignore>
                            <div class="product-images"> 
                                <div class="exzoom" id="exzoom">
                                    <div class="exzoom_img_box">
                                        <ul class='exzoom_img_ul'>
                                            @foreach ($product->productImages as $image)
                                            <li><img src="{{ asset($image->image) }}" alt="{{ $product->name }}"> </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="exzoom_nav"></div>
                                    <p class="exzoom_btn">
                                        <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a>
                                        <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="fa fa-angle-right" aria-hidden="true"></i> </a>
                                    </p>
                                </div>
                                <span class="brand bg-warning">Brand: <strong>{{ $product->brands->name }}</strong></span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title"><h2>{{ $product->name }}</h2></div>
                                <div class="ratting">
                                    @if ($product->rating->count() > 0)
                                        @php
                                            $rate_number = number_format($ratings_value);
                                        @endphp
                                        @for($i = 1; $i <= $rate_number; $i++)
                                        <i class="fa fa-star"></i>
                                        @endfor
                                        @for($j = $rate_number+1; $j <= 5; $j++)
                                        <i class="fa fa-star-o"></i>         
                                        @endfor 
                                    @else
                                        No review yet!                                        
                                    @endif

                                </div>
                                @if ($product->selling_price)
                                <div class="price">${{ $product->selling_price }} <span>${{ $product->orginal_price }}</span></div>
                                @else
                                <div class="price">${{ $product->orginal_price }}</div>
                                @endif
                                
                                <div class="details">
                                    {!! $product->small_description !!}
                                </div>

                                @if ($product->productColor->count() > 0)
                                    <div class="colors">                                   
                                        @foreach ($product->productColor as $color)
                                            <div class="single-color">
                                                <input type="radio" name="colorselect" id="color-{{ $color->id }}">
                                                <label for="color-{{ $color->id }}" class="bg-blue" wire:click="colorSelected({{ $color->id }})" style="background-color: {{ $color->color->code }}"> {{ $color->color->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>  

                                    @if ($this->productColorSelectedQuantity == 'outOfStock')
                                        <span class="stock bg-danger">Out of Stock</span>
                                    @else
                                        <span class="stock bg-success">In Stock</span>
                                    @endif  
                                    
                                @else                                
                                    @if ($product->quantity)
                                        <span class="stock bg-success">In Stock</span>
                                    @else
                                        <span class="stock bg-danger">Out of Stock</span>
                                    @endif   
                                @endif



                                <div class="quantity">
                                    <h4>Quantity:</h4>
                                    <div class="qty">
                                        <button type="button" class="btn-decrement" wire:loading.attr="disabled" wire:click="decrementQuantity"><i class="fa fa-minus"></i></button>
                                        <input type="text" value="{{ $this->quantityCount }}" wire:model="quantityCount" readonly>
                                        <button type="button" class="btn-increment" wire:loading.attr="disabled" wire:click="incrementQuantity"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="action">
                                    @if ($product->quantity > 0)
                                    <button wire:click="addToCart({{ $product->id }})">
                                        <span wire:loading.remove wire:target="addToCart({{ $product->id }})"><i class="fa fa-cart-plus"></i></span>
                                        <span wire:loading wire:target="addToCart({{ $product->id }})"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                                    </button>
                                    @endif
                                    <button wire:click="addwishlist({{ $product->id }})" type="button">
                                        <span wire:loading.remove wire:target="addwishlist({{ $product->id }})"><i class="fa fa-heart"></i></span>
                                        <span wire:loading wire:target="addwishlist({{ $product->id }})"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row product-detail-bottom" wire:ignore>
                        <div class="col-lg-12">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#reviews">Reviews ({{ $product->rating->count() }})</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="description" class="container tab-pane active"><br>
                                    <h4>Product description</h4>
                                    {!! $product->description !!}
                                </div>
                                <div id="reviews" class="container tab-pane fade"><br>
                                    <div class="reviewlist">
                                        @forelse ($product->rating as $review)
                                            <div class="reviews-submitted">
                                                <div class="reviewer">{{ $review->user->name }} - <span>{{ $review->updated_at->format('d M Y') }}</span></div>
                                                <div class="ratting">
                                                    @php
                                                        $review_rate_number = number_format($review->rating);
                                                    @endphp
                                                    @for($i = 1; $i <= $review_rate_number; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                    @for($j = $review_rate_number+1; $j <= 5; $j++)
                                                        <i class="fa fa-star-o"></i>         
                                                    @endfor 
                                                </div>
                                                <p>
                                                    {{ $review->review }}
                                                </p>
                                            </div>                                        
                                        @empty
                                        <h4 class="text-danger">This product has no review!</h4>
                                        @endforelse                                        
                                    </div>
   
                                    @guest
                                        <h4 class="text-danger">You need to login to make a reivew!</h4>
                                    @else
                                        <div class="reviews-submit" wire:ignore.>
                                            <h4>Give your Review:</h4>
                                            <form wire:submit.prevent="storeRatting">
                                                <div class="ratting">
                                                    <div class="ratting-labels">
                                                        <input type="radio" name="rating" value="5" id="rating-5" wire:model.defer="rating">
                                                        <label for="rating-5"></label>

                                                        <input type="radio" name="rating" value="4" id="rating-4" wire:model.defer="rating">
                                                        <label for="rating-4"></label>

                                                        <input type="radio" name="rating" value="3" id="rating-3" wire:model.defer="rating">
                                                        <label for="rating-3"></label>

                                                        <input type="radio" name="rating" value="2" id="rating-2" wire:model.defer="rating">
                                                        <label for="rating-2"></label>

                                                        <input type="radio" name="rating" value="1" id="rating-1" wire:model.defer="rating">
                                                        <label for="rating-1"></label>
                                                    </div>                                                
                                                </div>
                                                <div class="row form">
                                                    <div class="col-sm-12">
                                                        <textarea placeholder="Write a review" wire:model.defer="review"></textarea>
                                                        @error('review')
                                                            <p class="small text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <button type="submit">Submit</button>
                                                    </div>
                                                </div>                                            
                                            </form>
                                        </div>
                                    @endguest
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
                                                <button wire:click="addwishlist({{ $product->id }})" type="button">
                                                    <span wire:loading.remove><i class="fa fa-heart"></i></span>
                                                    <span wire:loading wire:target="addwishlist"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
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

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.exzoom.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery.exzoom.js') }}"></script>
    <script>
        $(function(){
            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": true,
                "autoPlayTimeout": 2000            
            });
        });

        window.addEventListener('comment-updated', event => {
            $('.reviewlist').load(location.href + " .reviewlist");
        });
    </script>
@endsection
