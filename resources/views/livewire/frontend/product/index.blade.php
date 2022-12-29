<div>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="product-search">
                                <input type="text" wire:model="search" placeholder="Search">
                                {{-- <button><i class="fa fa-search"></i></button> --}}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-short">
                                <div class="dropdown">
                                    {{-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">Product short by</a> --}}
                                    <select wire:model="short" class="form-control">
                                        <option value="ASC">Oldest</option>
                                        <option value="DESC">Newest</option>
                                    </select>
                                    {{-- <div class="dropdown-menu dropdown-menu-right">
                                        <button wire:model="short" value="DESC" class="dropdown-item">Newest</button>
                                        <button wire:model="short" value="ASC" class="dropdown-item">Popular</button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                @empty
                    <h5 class="text-center">No product found!</h5>
                @endforelse  
            </div>        
            
            <div class="col-lg-12 custom-pagination">
                {{ $products->links() }}
            </div>
        </div>                
    
        <div class="col-md-3">   
            @if ($category->brands->count() > 0)                    
            <div class="sidebar-widget brands">
                <h2 class="title">Our Brands</h2>
                <ul>
                    @foreach ($category->brands as $brand)
                        @if ($brand->products->count() > 0)
                            <li>
                                <label><input wire:model="brand" value="{{ $brand->id }}" type="checkbox">{{ $brand->name }}</label>
                                <span>({{ $brand->products->count() }})</span>
                            </li>  
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif  
                        
            <div class="sidebar-widget price">
                <h2 class="title">Price</h2>
                <label class="d-block">
                    <input type="radio" name="priceSort" wire:model="price" value="high-to-low" checked> High to Low
                </label>
                <label class="d-block">
                    <input type="radio" name="priceSort" wire:model="price" value="low-to-high"> Low to High
                </label>
            </div>
            
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
        </div>
    </div>
</div>