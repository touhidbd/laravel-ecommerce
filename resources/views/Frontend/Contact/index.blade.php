@extends('layouts.app')
@section('title', 'Contact Us | eCommerce Website')
@section('description', '')
@section('keywords', '')

@section('content')
    <!-- Contact Start -->
    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="form">
                        <form action="{{ url('/contact') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                                @error('subject')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                                @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div>
                                <button type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="contact-info">
                        <div class="section-header">
                            <h3>Get in Touch</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In condimentum quam ac mi viverra dictum. In efficitur ipsum diam, at dignissim lorem tempor in. Vivamus tempor hendrerit finibus.
                            </p>
                        </div>
                        <h4><i class="fa fa-map-marker"></i>123 E Shop, Los Angeles, CA, USA</h4>
                        <h4><i class="fa fa-envelope"></i>email@example.com</h4>
                        <h4><i class="fa fa-phone"></i>+123-456-7890</h4>
                        <div class="social">
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                            <a href=""><i class="fa fa-instagram"></i></a>
                            <a href=""><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection

@section('scripts')
@if (session('status')) 
<script>    
    Swal.fire({
        icon: 'success',
        // showConfirmButton: false,
        // timer: 2000,
        title: '{{ session("status") }}',
    })
</script>
@endif
@endsection