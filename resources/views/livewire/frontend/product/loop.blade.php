<div>
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
        @endforeach
    </div>
</div>
