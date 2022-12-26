<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', '0')->get();
        $categories = Categories::where('status', '0')->limit(3)->get();
        $products = Product::where('status', '0')->get();
        return view('frontend.index', compact('sliders', 'categories', 'products'));
    }
}
