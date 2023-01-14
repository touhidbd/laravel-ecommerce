<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => ['required','string'],
            'phone'  => ['required','digits:11'],
            'country'  => ['required','string'],
            'city'  => ['required','string'],
            'state'  => ['required','string'],
            'zip'  => ['required','string'],
            'address'  => ['required','string','max:500']
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name
        ]);

        $user->userDetail()->updateOrCreate(
            [
                'user_id'   => $user->id
            ],
            [
                'phone' => $request->phone,
                'country' => $request->country,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'address' => $request->address
            ]
        );
        return redirect()->back()->with('status', 'User details update successfully!');
    }

    public function passwordCreate()
    {
        return view('frontend.users.change-password');
    }

    public function changePasseord(Request $request)
    {
        $request->validate([
            'current_password'  => ['required', 'string', 'min:8'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);

        if($currentPasswordStatus)
        {
            User::findOrFail(Auth::user()->id)->update([
                'password'  => Hash::make($request->password)
            ]);

            return redirect()->back()->with('status', 'Password update successfully!');
        }
        else
        {
            return redirect()->back()->with('status', 'Current password does not match with the old password!');
        }
    }
}
