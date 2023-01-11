


<!-- Footer Start -->
<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h1>E Shop</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sollicitudin rutrum massa. Suspendisse sollicitudin rutrum massa. Vestibulum porttitor, metus sed pretium elementum, nisi nibh sodales quam, non lobortis neque felis id mauris.
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Useful Pages</h3>
                    <ul>
                        <li><a href="product.html">Product</a></li>
                        <li><a href="product-detail.html">Product Detail</a></li>
                        <li><a href="cart.html">Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="login.html">Login & Register</a></li>
                        <li><a href="my-account.html">My Account</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Quick Links</h3>
                    <ul>
                        <li><a href="product.html">Product</a></li>
                        <li><a href="cart.html">Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="login.html">Login & Register</a></li>
                        <li><a href="my-account.html">My Account</a></li>
                        <li><a href="wishlist.html">Wishlist</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <h3 class="title">Get in Touch</h3>
                    <div class="contact-info">
                        <p><i class="fa fa-map-marker"></i>{{ $appSettings->address }}</p>
                        <p><i class="fa fa-envelope"></i>{{ $appSettings->email1 }}</p>
                        <p><i class="fa fa-phone"></i>{{ $appSettings->phone1 }}</p>
                        <div class="social">
                            <a href="_blank" href="{{ $appSettings->twitter }}"><i class="fa fa-twitter"></i></a>
                            <a href="_blank" href="{{ $appSettings->facebook }}"><i class="fa fa-facebook"></i></a>
                            <a href="_blank" href="{{ $appSettings->instagram }}"><i class="fa fa-instagram"></i></a>
                            <a href="_blank" href="{{ $appSettings->youtube }}"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row payment">
            <div class="col-md-6">
                <div class="payment-method">
                    <p>We Accept:</p>
                    <img src="{{ asset('assets/img/payment-method.png') }}" alt="Payment Method" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="payment-security">
                    <p>Secured By:</p>
                    <img src="{{ asset('assets/img/godaddy.svg') }}" alt="Payment Security" />
                    <img src="{{ asset('assets/img/norton.svg') }}" alt="Payment Security" />
                    <img src="{{ asset('assets/img/ssl.svg') }}" alt="Payment Security" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Footer Bottom Start -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>Copyright &copy; <a href="https://tcoderbd.com">tCoderBD</a>. All Rights Reserved</p>
            </div>

            <div class="col-md-6 template-by">
                <p>Template By <a href="https://tcoderbd.com">tCoderBD</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Footer Bottom End -->


<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>