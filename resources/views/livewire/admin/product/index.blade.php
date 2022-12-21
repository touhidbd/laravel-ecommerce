<div>
      
    <div wire:ignore.self id="deleteModal" class="modal fade" data-bs-backdrop="static">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="destroyProduct">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Do you want to delete this product?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-white">Yes, Delete!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('status')) 
            <div class="alert alert-success" role="alert">
                {{ session("status") }}
            </div>
            @endif
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="cart-title m-0">Products</h4>
                    <a href="{{ url('/admin/add-product') }}" class="btn btn-sm btn-info">Add Product</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Trending</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                @php
                                    if($product->selling_price) {
                                        $price = $product->selling_price;
                                    } else {
                                        $price = $product->orginal_price;
                                    }
                                @endphp
                                <tr class="{{$product->status == '1' ? 'table-danger':''}}">
                                    <td>{{ $product->name }}</td>
                                    <td>${{ $price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        @if ($product->category)
                                            {{ $product->category->name }}
                                        @else
                                            No Category
                                        @endif                                    
                                    </td>
                                    <td>
                                        @if ($product->brands)
                                            {{ $product->brands->name }}
                                        @else
                                            No Brand
                                        @endif                                    
                                    </td>
                                    <td>{{ $product->trending == '1' ? 'Yes':'No' }}</td>
                                    <td>{{ $product->status == '1' ? 'Hidden':'Visible' }}</td>
                                    <td>
                                        <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" class="btn btn-sm btn-success text-white">Edit</a>
                                        <a href="#" wire:click="deleteProduct({{$product->id}})" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush