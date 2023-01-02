<!-- Top Header Start -->
<div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="search">
                    <input type="text" placeholder="Search">
                    <button><i class="fa fa-search"></i></button>
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

                            <a href="{{ url('admin/my-account') }}" class="dropdown-item">{{ __('My Account') }}</a>
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
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu">
                            <a href="product-list.html" class="dropdown-item">Product</a>
                            <a href="product-detail.html" class="dropdown-item">Product Detail</a>
                            <a href="cart.html" class="dropdown-item">Cart</a>
                            <a href="wishlist.html" class="dropdown-item">Wishlist</a>
                            <a href="checkout.html" class="dropdown-item">Checkout</a>
                            <a href="login.html" class="dropdown-item">Login & Register</a>
                            <a href="my-account.html" class="dropdown-item">My Account</a>
                        </div>
                    </div>
                    <a href="{{ url('contact-us') }}" class="nav-item nav-link">Contact Us</a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Header End -->