<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brands;
use Livewire\Component;
use App\Models\Categories;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    use WithFileUploads;
    
    public $name, $slug, $image, $status, $brand_id, $category_id;

    public function rules()
    {
        return [
            'name'          => 'required|string',
            'status'        => 'nullable',
            'category_id'   => 'required|integer',
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->image = NULL;
        $this->status = NULL;
        $this->category_id = NULL;
        $this->brand_id = NULL;
    }
    
    public function storeBrand()
    {

        $validImage = $this->validate([
            'image' => 'nullable|image',
        ]);
        
        $validatedData = $this->validate();
        $brand = new Brands;
        $brand->name = $this->name;
        $brand->slug = Str::slug($this->name);
        $brand->category_id = $this->category_id;
        $brand->status = $this->status == true ? '1':'0';

        if ($validImage)
        {
            $file = $this->image;
            $file->store('brand','public');
            $brand->image = $this->image->hashName();
        }
        $brand->save();

        session()->flash('status', 'Brand added successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;

        $brand = Brands::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->image = $brand->image;
        $this->category_id = $brand->category_id;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        $brand = Brands::find($this->brand_id);

        $brand->name = $this->name;
        $brand->slug = Str::slug($this->slug);
        $brand->status = $this->status == true ? '1':'0';
        $brand->category_id = $this->category_id;

        $validImage = $this->validate([
            'image' => 'nullable',
        ]);

        if ($this->image !== $brand->image)
        {
            if($brand->image)
            {
                Storage::delete('public/brand/'.$brand->image);
            }            
            $this->image->store('brand','public');
            $brand->image = $this->image->hashName();
        }

        $brand->update();

        session()->flash('status', 'Brand update successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();  
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        $brand = Brands::findOrFail($this->brand_id);   
        Storage::delete('public/brand/'.$brand->image);
        $brand->delete();    
        
        session()->flash('status', 'Brand deleted successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput(); 
    }

    public function render()
    {
        $categories = Categories::where('status', '0')->get();
        $brands = Brands::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])->extends('layouts.admin')->section('content');
    }
}
