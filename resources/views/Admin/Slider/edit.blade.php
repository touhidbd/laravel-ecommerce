@extends('layouts.admin')
@section('title', 'Edit Slider | Laravel Ecommerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="cart-title m-0">Edit Slider</h4>
                <a href="{{ url('admin/sliders') }}" class="btn btn-sm btn-info">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/slider/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-input">
                                <label for="title" class="mb-2">Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ $slider->title }}">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
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
                                <img width="100" src="{{ url('uploads/slider/'.$slider->image) }}" alt="{{ $slider->name }}">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-input mb-5">
                        <label for="description" class="mb-2">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control summernote">{{ $slider->description }}</textarea>
                        @error('description')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" {{ $slider->status == '1' ? 'checked':'' }}>
                        <label class="custom-control-label" for="status">Hidden</label>
                        @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>              
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary text-white">Update Slider</button>
                    </div>                    
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