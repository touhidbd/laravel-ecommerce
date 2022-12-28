<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brands;
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
        $brands = Brands::where('status', '0')->get();
        return view('frontend.index', compact('sliders', 'categories', 'products', 'brands'));
    }
    
    public function categories()
    {
        $categories = Categories::where('status', '0')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {
        $category = Categories::where('slug', $category_slug)->first();
        if($category)
        {
            $products = $category->products()->get();
            return view('frontend.collections.Products.index', compact('products', 'category'));
        }
        else
        {
            return redirect()->back()->with('status', 'Category not found!');
        }
    }
}