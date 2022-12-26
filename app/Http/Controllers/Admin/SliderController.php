<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\SliderFormRequest;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.add');
    }

    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        $slider = new Slider;
        $slider->title = $validatedData['title'];
        $slider->description = $validatedData['description'];

        if ($request->file('image')!=null)
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $slider->image = $filename;
        }
        $slider->status = $request->status == true ? '1':'0';
        $slider->save();
        
        return redirect('admin/sliders')->with('status', 'Slider added successfully!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, $slider_id)
    {
        $validatedData = $request->validated();

        $slider = Slider::find($slider_id);
        $slider->title = $validatedData['title'];
        $slider->description = $validatedData['description'];


        if($request->hasFile('image'))
        {
            $destination = 'uploads/slider/'.$slider->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $slider->image = $filename;
        }

        $slider->status = $request->status == true ? '1':'0';
        $slider->update();
        
        return redirect('admin/slider/'.$slider_id.'/edit')->with('status', 'Slider update successfully!'); 
    }
}
