<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Product;
use Livewire\Component;
use App\Models\Categories;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CategoryFormRequest;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $category_id;    

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $category = Categories::find($this->category_id);
        $path = 'uploads/category/'.$category->image;
        if(File::exists($path))
        {
            File::delete($path);
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
        session()->flash('status', 'Category deleted successfully!');
        $this->dispatchBrowserEvent('close-modal');
    }
    
    public function render()
    {
        $categories = Categories::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}
