<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.add');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Categories;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);
        $category->description = $validatedData['description'];

        if ($request->file('image')!=null)
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/',$filename);
            $category->image = $filename;
        }
        else {

        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1':'0';
        $category->save();
        
        return redirect('admin/category')->with('status', 'Category added successfully!');
    }

    public function edit(Categories $category)
    {
        // // $category = Categories::where('id', $category)->first();
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category_id)
    {
        $validatedData = $request->validated();
        $category = Categories::find($category_id);
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        if($request->hasFile('image'))
        {
            $destination = 'uploads/category/'.$category->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/category/',$filename);
            $category->image = $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_description = $validatedData['meta_description'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->status = $request->status == true ? '1':'0';
        $category->update();

        return redirect('admin/category/'.$category_id.'/edit')->with('status', 'Category update successfully!');
    }

    public function delete(Request $request)
    {
        $category = Categories::find($request->category_id);
        if($category)
        {
            $destination = 'uploads/category/'.$category->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $products = Product::where('category_id', $this->category_id)->get();

            if($products)
            {
                foreach($products as $product)
                {
                    if($product->productImages) 
                    {
                        foreach($product->productImages as $image)
                        {
                            if(File::exists($image->image))
                            {
                                File::delete($image->image);
                            }
                        }
                    }
                }
            }
            
            $category->delete();
            return redirect('admin/category/')->with('status', 'Category deleted successfully!');
        }
        else
        {
            return redirect('admin/category/')->with('status', 'No category found!');
        }
    }
}
