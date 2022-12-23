@extends('layouts.admin')
@section('title', 'Edit Product | Laravel Ecommerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="cart-title m-0">Edit Product</h4>
                <a href="{{ url('admin/products') }}" class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">               
                <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PUT')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#basic-details" type="button" role="tab" aria-controls="basic-details" aria-selected="true">Basic Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#product-details" type="button" role="tab" aria-controls="product-details" aria-selected="false">Product Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#product-image" type="button" role="tab" aria-controls="product-image" aria-selected="false">Product Images</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#product-color" type="button" role="tab" aria-controls="product-color" aria-selected="false">Product Color</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#seo-tags" type="button" role="tab" aria-controls="seo-tags" aria-selected="false">SEO Tags</button>
                        </li>
                    </ul>
                    <div class="tab-content border p-4 mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="basic-details" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <h4 class="mb-4 border-bottom pb-2">Basic Details</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <label for="name" class="mb-2">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <label for="slug" class="mb-2">Slug</label>
                                        <input type="text" class="form-control" name="slug" id="slug" value="{{ $product->slug }}">
                                        @error('slug')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                            </div>                    
                            <div class="form-input mb-5">
                                <label for="small_description" class="mb-2">Small Description</label>
                                <textarea name="small_description" id="small_description" cols="30" rows="10" class="form-control summernote">{{ $product->small_description }}</textarea>
                                @error('small_description')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="category_id" class="mb-2">Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id ==  $category->id ? 'selected':''}}>{{ $category->name }}</option>
                                        @endforeach                            
                                    </select>
                                    @error('category_id')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="brand" class="mb-2">Brand</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"{{ $product->brand ==  $brand->id ? 'selected':''}}>{{ $brand->name }}</option>
                                        @endforeach                            
                                    </select>
                                    @error('brand')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-switch mb-3">
                                        <label for="brand" class="mb-2">Trending</label> <br>
                                        <input type="checkbox" class="custom-control-input" id="trending" name="trending" {{ $product->trending == '1' ? 'checked':'' }}>
                                        <label class="custom-control-label" for="trending">Yes</label>
                                        @error('trending')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>                                 
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-switch mb-3">
                                        <label for="brand" class="mb-2">Hidden</label> <br>
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" {{ $product->status == '1' ? 'checked':'' }}>
                                        <label class="custom-control-label" for="status">Yes</label>
                                        @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>                                 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-details" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <h4 class="mb-4 border-bottom pb-2">Product Details</h4>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-input">
                                        <label for="orginal_price" class="mb-2">Orginal Price</label>
                                        <input type="text" class="form-control" name="orginal_price" id="orginal_price" value="{{ $product->orginal_price }}">
                                        @error('orginal_price')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>    
                                <div class="col-md-4">
                                    <div class="form-input">
                                        <label for="selling_price" class="mb-2">Selling Price</label>
                                        <input type="text" class="form-control" name="selling_price" id="selling_price" value="{{ $product->selling_price }}">
                                        @error('selling_price')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>   
                                <div class="col-md-4">
                                    <div class="form-input">
                                        <label for="quantity" class="mb-2">Quantity</label>
                                        <input type="text" class="form-control" name="quantity" id="quantity" value="{{ $product->quantity }}">
                                        @error('quantity')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>    
                            </div>     
                            <div class="form-input mb-5">
                                <label for="description" class="mb-2">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control summernote">{{ $product->description }}</textarea>
                                @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-image" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <h4 class="mb-4 border-bottom pb-2">Product Images</h4>                         
                            <div class="form-input">
                                <input type="file" class="form-control" name="image[]" id="image" multiple>
                                @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            @if ($product->productImages)
                                <ul class="image-list">
                                    @foreach ($product->productImages as $productImage)
                                        <li class="image-area">
                                            <img class="img" src="{{ asset($productImage->image) }}" alt="">
                                            <button type="button" class="btn-close deleteImage" value="{{ $productImage->id }}"></button>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                            <h4>No Images Upload!</h4>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="product-color" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <h4 class="mb-4 border-bottom pb-2">Product Color</h4>
                            <div class="row" class="not-used-color">
                                @forelse ($colors as $color)                                    
                                    <div class="col-md-3 mb-4">
                                        <div class="border p-3">
                                            <div class="input-field mb-3">
                                                <input id="color-{{ $color->id }}" type="checkbox" name="color[{{ $color->id }}]" value="{{ $color->id }}">
                                                <label for="color-{{ $color->id }}">{{ $color->name }}</label>
                                            </div>
                                            <div class="input-field mb-3">
                                                <label class="mb-2">Quantity:</label>
                                                <input type="text" name="colorquantity[{{ $color->id }}]"> 
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h2 class="text-center text-danger mb-5">No Colors Found!</h2>
                                @endforelse
                            </div>
                            @if ($product->productColor->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-borderd product-color-list">
                                    <thead>
                                        <tr>
                                            <th>Color Name</th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->productColor as $product_color)
                                            <tr class="product-color-tr">
                                                <td>
                                                    @if ($product_color->color)
                                                    {{ $product_color->color->name }}
                                                    @else
                                                    No Color Found
                                                    @endif                                                    
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3" style="width: 150px">
                                                        <input type="number" value="{{ $product_color->quantity }}" class="form-control form-control-sm productColorQuantity">
                                                        <button value="{{ $product_color->id }}" class="updateProductColor btn btn-primary btn-sm text-white" type="button">Update</button>
                                                    </div>
                                                </td>
                                                <td><button value="{{ $product_color->id }}" class="deleteProductColor btn btn-danger btn-sm text-white" type="button">Delete</button></td>
                                            </tr>                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="seo-tags" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <h4 class="mb-4 border-bottom pb-2">SEO Tags</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">                            
                                    <div class="form-input">
                                        <label for="meta_title" class="mb-2">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $product->meta_title }}">
                                        @error('meta_title')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                            </div>             
                            <div class="form-input mb-3">
                                <label for="meta_keyword" class="mb-2">Meta Keyword</label>
                                <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="10" class="form-control">{{ $product->meta_keyword }}</textarea>
                                @error('meta_keyword')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>                 
                            <div class="form-input mb-3">
                                <label for="meta_description" class="mb-2">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $product->meta_description }}</textarea>
                                @error('meta_description')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-primary text-white mt-4">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" data-bs-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Do you want to delete this image?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">    
                <img class="result-image" src="" alt="" width="300">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white yesDeleteImage" id="image_id">Yes Delete!</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if (session('status')) 
<script>    
    Swal.fire({
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        title: '{{ session("status") }}',
    })
</script>
@endif
<script>        
    $(document).ready(function(){

        // Delete Image
        $(document).on('click', '.deleteImage', function(e){
            e.preventDefault();  

            $('#image_id').val($(this).val());  
            
            var image = $(this).closest('.image-area').find('.img').attr('src');
            $('.result-image').attr('src', image);

            $('#deleteModal').modal('show');
        });

        $(document).on('click', '.yesDeleteImage', function(e){
            e.preventDefault(); 
            var image_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '{{ url("admin/delete-image") }}',
                data: {
                    'image_id': image_id,
                },
                success: function (response) {
                    $('.image-list').load(location.href + " .image-list");
                    $('#deleteModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        title: response.message,
                    })
                }
            });
        });

        // Update & Delete Color
        $(document).on('click', '.updateProductColor', function(e){
            e.preventDefault(); 

            var product_id = '{{ $product->id }}';
            var color_id = $(this).val();
            var quantity = $(this).closest('.product-color-tr').find('.productColorQuantity').val();

            if(quantity <= 0)
            {
                alert('Quantity is required!');
                return false
            }
            
            var data = {
                'product_id'    : product_id,
                'color_id'      : color_id,
                'quantity'      : quantity,
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ url("admin/product-color") }}/'+color_id,
                data: data,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        title: response.message,
                    });
                }
            });
        });

        $(document).on('click', '.deleteProductColor', function(e){
            e.preventDefault();

            confirm('Do you want to delete this color?');

            var product_id = '{{ $product->id }}';
            var color_id = $(this).val();
            
            var data = {
                'product_id'    : product_id,
                'color_id'      : color_id,
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ url("admin/product-color") }}/'+color_id+'/delete',
                data: data,                
                success: function(response) {
                    $('.product-color-list').load(location.href + " .product-color-list");
                    Swal.fire({
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        title: response.message,
                    });
                }
            });
        });
    });
</script>
@endsection