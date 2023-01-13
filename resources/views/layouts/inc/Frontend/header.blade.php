<!-- Top Header Start -->
<div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="{{ $appSettings->website_name }}">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="search">
                    <form action="{{ url('search') }}" method="GET">
                        <input type="text" placeholder="Search" value="{{ Request::get('s') }}" name="s">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-md-3">
                <div class="user">
                    @guest
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account</a>
                        <div class="dropdown-menu">
                            @if (Route::has('login'))
                                <a href="{{ route('login') }}" class="dropdown-item">{{ __('Login') }}</a>
                            @endif

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="dropdown-item">{{ __('Register') }}</a>
                            @endif                            
                        </div>
                    </div>                    
                    @else
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu">
                            @if (Auth::user()->role_as == 1)
                            <a href="{{ url('admin/dashboard') }}" class="dropdown-item">{{ __('Dashboard') }}</a>
                            @endif                             
                            <a href="{{ url('orders') }}" class="dropdown-item">{{ __('My Orders') }}</a><a href="{{ url('profile') }}" class="dropdown-item">{{ __('My Prfile') }}</a>
                            <a href="{{ url('change-password') }}" class="dropdown-item">{{ __('Change Password') }}</a>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div> 
                    @endguest
                    <div class="cart">
                        <a href="{{ url('/cart') }}">
                            <i class="fa fa-cart-plus"></i>
                            <livewire:frontend.cart.cart-count />
                        </a> |
                        <a href="{{ url('/wishlist') }}">
                            <i class="fa fa-heart"></i>
                            <livewire:frontend.wishlist.count />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Header End -->

<!-- Header Start -->
<div class="header">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav m-auto">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="{{ url('/collections') }}" class="nav-item nav-link">Collections</a>
                    <a href="{{ url('/new-arrivals') }}" class="nav-item nav-link">New Arrivals</a>
                    <a href="{{ url('contact-us') }}" class="nav-item nav-link">Contact Us</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Header End -->