@extends('layouts.admin')
@section('title', 'Settings | Laravel Ecommerce')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ url('/admin/settings') }}" method="POST">
            @csrf
            <div class="card mb-3">
                <div class="card-header py-3 bg-info">
                    <h4 class="cart-title text-white m-0">Settings</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="website_name">Website Name</label>
                            <input value="{{ $settings->website_name }}" id="website_name" type="text" name="website_name" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="website_url">Website URL</label>
                            <input value="{{ $settings->website_url }}" id="website_url" type="text" name="website_url" class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-2" for="page_title">Page Title</label>
                            <input value="{{ $settings->page_title }}" id="page_title" type="text" name="page_title" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="meta_keywords">Meta Keywords</label>
                            <textarea id="meta_keywords" type="text" name="meta_keywords" class="form-control" row="3" col="10">{{ $settings->meta_keywords }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="meta_description">Meta Description</label>
                            <textarea id="meta_description" type="text" name="meta_description" class="form-control" row="3" col="10">{{ $settings->meta_description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header py-3 bg-info">
                    <h4 class="cart-title text-white m-0">Website Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="address">Address</label>
                            <textarea id="address" type="text" name="address" class="form-control" row="3">{{ $settings->address }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="phone1">Phone 1</label>
                            <input value="{{ $settings->phone1 }}" id="phone1" type="text" name="phone1" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="phone2">Phone 2</label>
                            <input value="{{ $settings->phone2 }}" id="phone2" type="text" name="phone2" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="email1">Email 1</label>
                            <input value="{{ $settings->email1 }}" id="email1" type="email" name="email1" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="email2">Email 2</label>
                            <input value="{{ $settings->email2 }}" id="email2" type="email" name="email2" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header py-3 bg-info">
                    <h4 class="cart-title text-white m-0">Website Social Media</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="facebook">Facebook</label>
                            <input value="{{ $settings->facebook }}" id="facebook" type="text" name="facebook" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="twitter">Twitter</label>
                            <input value="{{ $settings->twitter }}" id="twitter" type="text" name="twitter" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="instagram">Instagram</label>
                            <input value="{{ $settings->instagram }}" id="instagram" type="text" name="instagram" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mb-2" for="youtube">Youtube</label>
                            <input value="{{ $settings->youtube }}" id="youtube" type="text" name="youtube" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">Save Settings</button>
            </div>
        </form>
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