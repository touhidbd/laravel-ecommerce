<div>
    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/collections') }}">Collections</a></li>
                <li class="breadcrumb-item active">Wishlist</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    
    
    <!-- Wishlist Start -->
    <div class="cart-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Add to Cart</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @forelse ($wishlist as $singlewishlist)
                                    @if ($singlewishlist->product)
                                    <tr>
                                        @php
                                            if($singlewishlist->product->selling_price) {
                                                $price = $singlewishlist->product->selling_price;
                                            } else {
                                                $price = $singlewishlist->product->orginal_price;
                                            }                                            
                                        @endphp
                                        <td><a href="{{ url('collections/'.$singlewishlist->product->category->slug.'/'.$singlewishlist->product->slug) }}"><img src="{{ asset($singlewishlist->product->productImages[0]->image) }}" alt="{{ $singlewishlist->product->name }}"></a></td>
                                        <td><a href="{{ url('collections/'.$singlewishlist->product->category->slug.'/'.$singlewishlist->product->slug) }}">{{ $singlewishlist->product->name }}</a></td>
                                        <td>${{ $price }}</td>
                                        <td>
                                            <div class="qty">
                                                <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="1">
                                                <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td><button>Add to Cart</button></td>
                                        <td><button wire:click="removeproduct({{ $singlewishlist->id }})">
                                            <span wire:loading.remove wire:target="removeproduct({{ $singlewishlist->id }})"><i class="fa fa-trash"></i></span>
                                            <span wire:loading wire:target="removeproduct({{ $singlewishlist->id }})"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
                                        </button></td>
                                    </tr>
                                    @endif                                
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-danger">No wishlist added!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>       
            
                    <div class="custom-pagination">
                        {{ $wishlist->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist End -->
</div>