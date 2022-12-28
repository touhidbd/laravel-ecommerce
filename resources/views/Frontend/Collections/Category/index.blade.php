@extends('layouts.app')
@section('title', 'All Collections')
@section('description', '')
@section('keywords', '')

@section('content')
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Collections</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Category List Start -->
<div class="product-view">
    <div class="container">
        <div class="section-header">
            <h3>All Collections</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
            </p>
        </div>
        <div class="row">        
            @forelse ($categories as $category)
                <div class="col-6 col-md-4">
                    <div class="category-card">
                        <a href="{{ url('collections/'.$category->slug) }}">
                            <div class="category-card-img">
                                <img src="{{ url('uploads/category/'.$category->image) }}" class="w-100" alt="{{ $category->name }}">
                            </div>
                            <div class="category-card-body">
                                <h5>{{ $category->name }}</h5>
                            </div>
                        </a>
                    </div>
                </div>    
            @empty
            <h5 class="text-center">No Categories available!</h5>            
            @endforelse
        </div>
    </div>
</div>
<!-- Category List End -->
@endsection