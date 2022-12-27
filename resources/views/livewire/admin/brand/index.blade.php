@section('title', 'Brands | eCommerce')
<div>
    @include('livewire.admin.brand.modal-form')

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('status')) 
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("status") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h4 class="cart-title m-0">Brands</h4>
                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#brandModal">Add Brand</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr class="{{$brand->status == '1' ? 'table-danger':''}}">
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->slug }}</td>
                                    <td>
                                        @if ($brand->image)
                                            <img src="{{ asset('storage/brand/'.$brand->image) }}" alt="{{ $brand->name }}">
                                        @else
                                        No image
                                        @endif
                                    </td>
                                    <td>{{ $brand->status == '1' ? 'Hidden':'Visible' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success text-white" data-bs-toggle="modal" data-bs-target="#updateBrandModal" wire:click="editBrand({{$brand->id}})">Edit</a>
                                        <a href="#" wire:click="deleteBrand({{$brand->id}})" class="btn btn-danger btn-sm text-white" data-bs-toggle="modal" data-bs-target="#deleteBrandModal">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 justify-content-center">
                            {{ $brands->links() }}
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
            $('#brandModal,#updateBrandModal,#deleteBrandModal').modal('hide');
        });
    </script>
@endpush