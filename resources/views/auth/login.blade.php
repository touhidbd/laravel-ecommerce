@extends('layouts.app')
@section('title', 'Login | eCommerce Laravel')

@section('content')

<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active">Login</li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="login">
    <div class="container">
        <div class="section-header">
            <h3>User Login</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies. Nullam consequat, mauris non interdum cursus
            </p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="login-form">
                        <div class="row">
                            <div class="col-md-6">
                                <label>E-mail</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="newaccount" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="newaccount">{{ __('Keep me signed in') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn">
                                    {{ __('Login') }}
                                </button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>                
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->
@endsection
