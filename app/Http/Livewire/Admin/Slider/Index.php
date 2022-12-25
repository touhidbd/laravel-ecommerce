<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $slider_id;

    public function deleteSlider($slider_id)
    {
        $this->slider_id = $slider_id;
    }

    public function destroySlider()
    {
        $slider = Slider::findOrFail($this->slider_id); 
        
        $destination = 'uploads/slider/'.$slider->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $slider->delete();

        session()->flash('status', 'Slider deleted successfully!');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $sliders = Slider::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.slider.index',['sliders' => $sliders]);
    }
}
