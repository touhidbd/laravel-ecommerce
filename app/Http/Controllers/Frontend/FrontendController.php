<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brands;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Frontend\ContactFormRequest;

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
        $categories = Categories::where('status', '0')->limit(6)->get();
        
        if($category)
        {
            $featured_product = Product::where('status', '0')->where('trending', '1')->where('category_id', '!=' , $category->id)->inRandomOrder()->first();
            return view('frontend.collections.products.index', compact('category', 'categories', 'featured_product'));
        }
        else
        {
            return redirect()->back()->with('status', 'Category not found!');
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Categories::where('slug', $category_slug)->first();
        
        if($category)
        {
            $featured_product = Product::where('status', '0')->where('trending', '1')->where('category_id', '!=' , $category->id)->inRandomOrder()->first();
            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if($product)
            {
                return view('frontend.collections.products.view', compact('category', 'product', 'featured_product'));
            }
            else
            {
                return redirect('/')->with('status', 'Product not found!');
            }            
        }
        else
        {
            return redirect('/')->with('status', 'Category not found!');
        }
    }

    public function contact()
    {
        return view('frontend.contact.index');
    }

    public function send_mail(ContactFormRequest $request)
    {
        $validatedData = $request->validated();
        
        $name = $validatedData['name'];
        $email = $validatedData['email'];
        $subject = $validatedData['subject'];
        $user_message = $validatedData['message'];

        $data = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'user_message' => $user_message
        ];
        
        Mail::send('frontend.contact.success', $data, function($message) {
            $message->from('no-reply@tcoderbd.com', 'tCoder Bangladesh')->to('touhidul.sadeek@gmail.com', 'Touhidul Sadeek')->subject('New Contact Form Submission | eCommerce Laravel');
        });

        return redirect('/contact-us')->with('status', 'Thank you for your interest! We will contact with you as soon as possible.');
    }

    public function thankyou()
    {
        return view('frontend.pages.thank-you');
    }

    public function newArrivals()
    {
        $featured_product = Product::where('status', '0')->where('trending', '1')->inRandomOrder()->first();
        $categories = Categories::where('status', '0')->get();
        $products = Product::where('status', '0')->latest()->paginate(10);
        $brands = Brands::where('status', '0')->get();
        return view('frontend.pages.new-arrivals', compact('products', 'featured_product', 'brands', 'categories'));
    }
}
