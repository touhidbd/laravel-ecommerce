<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;

Auth::routes();

// Front End
Route::get('/', [FrontendController::class, 'index']);
Route::get('/collections', [FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [FrontendController::class, 'products']);
Route::get('/contact-us', [FrontendController::class, 'contact']);
Route::post('/contact', [FrontendController::class, 'send_mail']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function(){
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

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
        Route::get('/product-color/{color_id}/delete', 'deleteProductColor');
    });

    Route::controller(SliderController::class)->group(function() {
        Route::get('/sliders', 'index');
        Route::get('/add-slider', 'create');
        Route::post('/slider', 'store');
        Route::get('/slider/{slider}/edit', 'edit');
        Route::put('/slider/{slider}', 'update');
    });

    // Color
    Route::get('/colors', App\Http\Livewire\Admin\Color\Index::class);
});
