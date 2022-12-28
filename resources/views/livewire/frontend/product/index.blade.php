<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="product-search">
                        <input type="text" placeholder="Search">
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
