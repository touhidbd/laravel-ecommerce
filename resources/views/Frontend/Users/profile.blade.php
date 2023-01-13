@extends('layouts.app')
@section('title', 'Profile | eCommerce Laravel Website')
@section('description', '')
@section('keywords', '')

@section('content')    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">My Profile</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->    

    <div class="container my-5">
        <div class="section-header">
            <h3>My Profile</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('status'))
                    <h5 class="alert alert-success">{{ session('status') }}</h5>
                @endif          
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Profile Details</h6>
                        <a href="{{ url('/change-password') }}" class="btn btn-warning text-white">Change Password</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/profile') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ Auth::user()->userDetail->phone }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" value="{{ Auth::user()->userDetail->country }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" value="{{ Auth::user()->userDetail->city }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" name="state" value="{{ Auth::user()->userDetail->state }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Zip</label>
                                    <input type="text" class="form-control" name="zip" value="{{ Auth::user()->userDetail->zip }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="address" rows="3">{{ Auth::user()->userDetail->address }}</textarea>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>      
            </div>
        </div>
    </div>
@endsection