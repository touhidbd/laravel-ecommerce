<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $settings = Setting::first();
        if($settings)
        {
            // Update Settings
            $settings->update([
                'website_name' => $request->website_name,
                'website_url'  => $request->website_url,
                'page_title'   => $request->page_title,
                'meta_keywords'    => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'address'  => $request->address,
                'phone1'   => $request->phone1,
                'phone2'   => $request->phone2,
                'email1'   => $request->email1,
                'email2'   => $request->email2,
                'facebook' => $request->facebook,
                'twitter'  => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube
            ]);

            return redirect()->back()->with('status', 'Website settings update successfully!');
        }
        else
        {
            // Create Settings
            Setting::create([
                'website_name' => $request->website_name,
                'website_url'  => $request->website_url,
                'page_title'   => $request->page_title,
                'meta_keywords'    => $request->meta_keywords,
                'meta_description' => $request->meta_description,
                'address'  => $request->address,
                'phone1'   => $request->phone1,
                'phone2'   => $request->phone2,
                'email1'   => $request->email1,
                'email2'   => $request->email2,
                'facebook' => $request->facebook,
                'twitter'  => $request->twitter,
                'instagram' => $request->instagram,
                'youtube' => $request->youtube
            ]);

            return redirect()->back()->with('status', 'Website settings save successfully!');
        }
    }
}
