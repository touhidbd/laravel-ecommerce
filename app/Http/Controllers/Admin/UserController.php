<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);

        return redirect('/admin/users')->with('status', 'User created successfully!');
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        return view('Admin.Users.edit', compact('user'));
    }

    public function update(Request $request, int $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);

        User::findOrFail($userId)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);

        return redirect('/admin/user/'.$userId.'/edit')->with('status', 'User update successfully!');
    }
}
