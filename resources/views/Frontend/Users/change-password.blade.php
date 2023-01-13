@extends('layouts.app')
@section('title', 'Change Password | eCommerce Laravel Website')
@section('description', '')
@section('keywords', '')

@section('content')    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/profile') }}">My Profile</a></li>
                <li class="breadcrumb-item active">Change Password</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->    

    <div class="container my-5">
        <div class="section-header">
            <h3>Change Password</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">

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
                        <h6 class="mb-0">Change Password</h6>
                        <a href="{{ url('/change-password') }}" class="btn btn-warning text-white">Profile Details</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/change-password') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control" name="current_password" >
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation">
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