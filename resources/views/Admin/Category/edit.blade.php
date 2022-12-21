@extends('layouts.admin')
@section('title', 'Edit Category | Laravel Ecommerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="cart-title m-0">Edit Category</h4>
                <a href="{{ url('admin/category') }}" class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-input">
                                <label for="name" class="mb-2">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">                            
                            <div class="form-input">
                                <label for="slug" class="mb-2">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug" value="{{ $category->slug }}">
                                @error('slug')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div> 
                    <div class="row mb-3">
                        <div class="col-md-6">                            
                            <div class="form-input">
                                <label for="image" class="mb-2">Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                                @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-input">
                                <img width="100" src="{{ url('uploads/category/'.$category->image) }}" alt="{{ $category->name }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-input mb-5">
                        <label for="description" class="mb-2">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control summernote">{{ $category->description }}</textarea>
                        @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <h4 class="mb-4">SEO Tags</h4>
                    <div class="row mb-3">
                        <div class="col-md-6">                            
                            <div class="form-input">
                                <label for="meta_title" class="mb-2">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $category->meta_title }}">
                                @error('meta_title')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>             
                    <div class="form-input mb-3">
                        <label for="meta_keyword" class="mb-2">Meta Keyword</label>
                        <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="10" class="form-control">{{ $category->meta_keyword }}</textarea>
                        @error('meta_keyword')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>                 
                    <div class="form-input mb-3">
                        <label for="meta_description" class="mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control">{{ $category->meta_description }}</textarea>
                        @error('meta_description')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" {{ $category->status == '1' ? 'checked':'' }}>
                        <label class="custom-control-label" for="status">Hidden</label>
                        @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>              
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary text-white">Update Category</button>
                        {{-- <a href="{{ url('/admin/delete-category/'.$category->id) }}" class="btn btn-danger text-white">Delete Category</a> --}}
                        <button type="button" class="btn btn-danger deleteCategory text-white" value="{{ $category->id }}">Delete</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" data-bs-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('admin/delete-category/') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Do you want to delete this category?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="category_id" id="category_id">
                    <button type="submit" class="btn btn-danger text-white">Yes Delete!</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if (session('status')) 
<script>    
    Swal.fire({
        // position: 'top-end',
        icon: 'success',
        showConfirmButton: false,
        timer: 2000,
        title: '{{ session("status") }}',
    })
</script>
@endif
<script>        
    $(document).ready(function(){
        $(document).on('click', '.deleteCategory', function(e){
            e.preventDefault();
            var category_id = $(this).val();
            $('#category_id').val(category_id);
            $('#deleteModal').modal('show');
        });
    });
</script>
@endsection