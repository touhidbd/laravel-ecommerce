<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Models\Brands;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Categories::where('status', '0')->get();
        $brands = Brands::where('status', '0')->get();
        $colors = Color::where('status', '0')->get();
        return view('admin.products.create', compact('categories', 'brands', 'colors'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = Categories::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id'           => $validatedData['category_id'],
            'name'                  => $validatedData['name'],
            'slug'                  => Str::slug($validatedData['name']),
            'brand'                 => $validatedData['brand'],
            'small_description'     => $validatedData['small_description'],
            'description'           => $validatedData['description'],
            'orginal_price'         => $validatedData['orginal_price'],
            'selling_price'         => $validatedData['selling_price'],
            'quantity'              => $validatedData['quantity'],
            'trending'              => $request->trending == true ? '1':0,
            'status'                => $request->status == true ? '1':0,
            'meta_title'            => $validatedData['meta_title'],
            'meta_keyword'          => $validatedData['meta_keyword'],
            'meta_description'      => $validatedData['meta_description'],
        ]);
        
        if($request->hasFile('image'))
        {
            $i = 1;
            $path = 'uploads/products/';
            foreach($request->file('image') as $imageFile)
            {
                $extention = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extention;
                $imageFile->move($path,$filename);
                $finalImagePathName = $path.$filename;

                $product->productImages()->create([
                    'product_id'    => $product->id,
                    'image'         => $finalImagePathName   
                ]);
            }
        }

        if($request->color)
        {
            foreach($request->color as $key => $color)
            {
                $product->productColor()->create([
                    'product_id'    => $product->id,
                    'color_id'      => $color,
                    'quantity'      => $request->colorquantity[$key] ?? 0
                ]);
            }
        }
        
        return redirect('/admin/products')->with('status', 'Product added successfully!');
    }

    public function edit(int $product_id)
    {
        $categories = Categories::where('status', '0')->get();
        $brands = Brands::where('status', '0')->get();   
        $product = Product::findOrFail($product_id);

        $product_color = $product->productColor->pluck('color_id')->toArray();  
        $colors = Color::whereNotIn('id', $product_color)->get();      

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'colors'));
    }

    public function update(ProductFormRequest $request, int $product_id)
    {
        $validatedData = $request->validated();
        $product = Categories::findOrFail($validatedData['category_id'])->products()->where('id', $product_id)->first();
        
        if($product)
        {
            $product->update([
                'category_id'           => $validatedData['category_id'],
                'name'                  => $validatedData['name'],
                'slug'                  => Str::slug($validatedData['slug']),
                'brand'                 => $validatedData['brand'],
                'small_description'     => $validatedData['small_description'],
                'description'           => $validatedData['description'],
                'orginal_price'         => $validatedData['orginal_price'],
                'selling_price'         => $validatedData['selling_price'],
                'quantity'              => $validatedData['quantity'],
                'trending'              => $request->trending == true ? '1':0,
                'status'                => $request->status == true ? '1':0,
                'meta_title'            => $validatedData['meta_title'],
                'meta_keyword'          => $validatedData['meta_keyword'],
                'meta_description'      => $validatedData['meta_description'],
            ]);
            
            if($request->hasFile('image'))
            {
                $i = 1;
                $path = 'uploads/products/';
                foreach($request->file('image') as $imageFile)
                {
                    $extention = $imageFile->getClientOriginalExtension();
                    $filename = time().$i++.'.'.$extention;
                    $imageFile->move($path,$filename);
                    $finalImagePathName = $path.$filename;
    
                    $product->productImages()->create([
                        'product_id'    => $product->id,
                        'image'         => $finalImagePathName   
                    ]);
                }
            }  

            if($request->color)
            {
                foreach($request->color as $key => $color)
                {
                    $product->productColor()->create([
                        'product_id'    => $product->id,
                        'color_id'      => $color,
                        'quantity'      => $request->colorquantity[$key] ?? 0
                    ]);
                }
            }

            return redirect()->back()->with('status', 'Product update successfully!');
        }
        else
        {
            return redirect('/admin/products')->with('status', 'Product not found!');
        }
    }

    public function deleteimage(Request $request)
    {
        $product_image_id = $request->input('image_id');
        if($product_image_id)
        {
            $productImage = ProductImage::findOrFail($product_image_id);
            if(File::exists($productImage->image)){
                File::delete($productImage->image);
            }
            $productImage->delete();

            return response()->json([
                'status'    => 200,
                'message'   =>  'Image deleted successfully!'
            ]);               
        }
        else
        {
            return response()->json([
                'status'    => 500,
                'message'   => 'Image not found!'
            ]);  
        } 
    }

    public function updateProductColor(Request $request, $color_id)
    {
        $productColorData = Product::findOrFail($request->product_id)->productColor()->where('id', $color_id)->first();
        $productColorData->update([
            'quantity'  => $request->quantity
        ]);
        return response()->json([
            'status'    => 200,
            'message'   =>  'Product color quantity udpate successfully!'
        ]); 
    }

    public function deleteProductColor(Request $request, $color_id)
    {
        $productColorData = Product::findOrFail($request->product_id)->productColor()->where('id', $color_id)->first();
        $productColorData->delete();

        return response()->json([
            'status'    => 200,
            'message'   =>  'Product color deleted successfully!'
        ]); 
    }
}
