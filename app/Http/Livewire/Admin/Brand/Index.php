<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brands;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $name, $slug, $status, $brand_id;

    public function rules()
    {
        return [
            'name'      => 'required|string',
            // 'slug'      => 'required|string',
            'status'    => 'nullable',
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
    }
    
    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brands::create([
            'name'      => $this->name,
            'slug'      => Str::slug($this->name),
            'status'    => $this->status == true ? '1':'0'
        ]);
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
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brands::find($this->brand_id)->update([
            'name'      => $this->name,
            'slug'      => Str::slug($this->slug),
            'status'    => $this->status == true ? '1':'0'
        ]);
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
        $brand = Brands::findOrFail($this->brand_id)->delete();        
        session()->flash('status', 'Brand deleted successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput(); 
    }

    public function render()
    {
        $brands = Brands::orderBy('id', 'DESC')->paginate(3);
        return view('livewire.admin.brand.index', ['brands' => $brands])->extends('layouts.admin')->section('content');
    }
}
