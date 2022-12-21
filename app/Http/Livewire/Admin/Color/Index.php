<?php

namespace App\Http\Livewire\Admin\Color;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $name, $code, $status, $color_id;

    public function rules()
    {
        return [
            'name'      => 'required|string',
            'code'      => 'required|string',
            'status'    => 'nullable',
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->code = NULL;
        $this->status = NULL;
        $this->color_id = NULL;
    }
    
    public function storeColor()
    {
        $validatedData = $this->validate();
        Color::create([
            'name'      => $this->name,
            'code'      => $this->code,
            'status'    => $this->status == true ? '1':'0'
        ]);
        session()->flash('status', 'Color added successfully!');
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

    public function editColor(int $color_id)
    {
        $this->color_id = $color_id;

        $brand = Color::findOrFail($color_id);
        $this->name = $brand->name;
        $this->code = $brand->code;
        $this->status = $brand->status;
    }

    public function updateColor()
    {
        $validatedData = $this->validate();
        Color::find($this->color_id)->update([
            'name'      => $this->name,
            'code'      => $this->code,
            'status'    => $this->status == true ? '1':'0'
        ]);
        session()->flash('status', 'Color update successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();  
    }

    public function deleteColor($color_id)
    {
        $this->color_id = $color_id;
    }

    public function destroyColor()
    {
        $color = Color::findOrFail($this->color_id)->delete();        
        session()->flash('status', 'Color deleted successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput(); 
    }

    public function render()
    {
        $colors = Color::orderBy('id', 'DESC')->paginate(5);
        return view('livewire.admin.color.index', ['colors' => $colors])->extends('layouts.admin')->section('content');
    }
}
