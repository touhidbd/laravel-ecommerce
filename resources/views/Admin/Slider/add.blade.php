@extends('layouts.admin')
@section('title', 'Add Slider | Laravel Ecommerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="cart-title m-0">Add Slider</h4>
                <a href="{{ url('admin/slider') }}" class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/slider') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-input">
                                <label for="title" class="mb-2">Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">                            
                            <div class="form-input">
                                <label for="image" class="mb-2">Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                                @error('image')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>                    
                    <div class="form-input mb-5">
                        <label for="description" class="mb-2">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control summernote"></textarea>
                        @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input" id="status" name="status">
                        <label class="custom-control-label" for="status">Hidden</label>
                        @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>              
                    <button type="submit" class="btn btn-primary text-white">Add Slider</button>
                </form>
            </div>
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
@endsection