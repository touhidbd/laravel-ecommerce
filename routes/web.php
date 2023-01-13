<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\CartContoller;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\WishlistContoller;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;

Auth::routes();

// Front End
Route::controller(FrontendController::class)->group(function() {

    // Pages
    Route::get('/', 'index');    
    Route::get('/contact-us', 'contact');
    Route::post('/contact', 'send_mail');

    // Collection    
    Route::get('/collections', 'categories');
    Route::get('/collections/{category_slug}', 'products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView');

    // Thank you page
    Route::get('/thank-you', 'thankyou');

    // New Arrivals
    Route::get('/new-arrivals', 'newArrivals');   
    
    // Search Page
    Route::get('/search', 'searchProduct');
});


Route::middleware(['auth'])->group(function () {

    // Wishlist
    Route::get('/wishlist', [WishlistContoller::class, 'index']);

    // Cart
    Route::get('/cart', [CartContoller::class, 'index']);

    //Checkout
    Route::get('/checkout', [CheckoutController::class, 'index']);

    // Orders
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order_id}', [OrderController::class, 'show']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // Change Password
    Route::get('/change-password', [ProfileController::class, 'passwordCreate']);
    Route::post('/change-password', [ProfileController::class, 'changePasseord']);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function(){
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Settings
    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index');
        Route::post('/settings', 'store');
    });


    // Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/add-category', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category_id}', 'update');
        Route::post('/delete-category/', 'delete');
        Route::get('/delete-category/{category_id}', 'delete');
    });


    //Brands
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class);

    // Product
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/add-product', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::post('/delete-image', 'deleteimage');
        Route::post('/product-color/{color_id}', 'updateProductColor');
        Route::post('/product-color/{color_id}/delete', 'deleteProductColor');
    });

    Route::controller(SliderController::class)->group(function() {
        Route::get('/sliders', 'index');
        Route::get('/add-slider', 'create');
        Route::post('/slider', 'store');
        Route::get('/slider/{slider}/edit', 'edit');
        Route::put('/slider/{slider}', 'update');
    });

    Route::controller(OrdersController::class)->group(function() {
        Route::get('/orders', 'index');
        Route::get('/order/{order_id}', 'view');
        Route::post('/order/{order_id}', 'update');

        Route::get('/invoice/{order_id}', 'viewInvoice');
        Route::get('/invoice/{order_id}/generate', 'generateInvoice');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('/users', 'index');
        Route::post('/users', 'store');
        Route::get('/user/{user_id}/edit', 'edit');
        Route::post('/users/{user_id}', 'update');
        Route::get('/add-user', 'create');
    });

    // Color
    Route::get('/colors', App\Http\Livewire\Admin\Color\Index::class);
});
