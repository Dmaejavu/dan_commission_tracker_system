<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'position' => 'required|in:Admin,UnitManager',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password
            'position' => $request->position,
        ]);

        return redirect()->route('dashboardowner')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->userID . ',userID',
            'password' => 'nullable|string|min:6',
            'position' => 'required|in:Admin,UnitManager',
        ]);

        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->position = $request->position;
        $user->save();

        return redirect()->route('dashboardowner')->with('success', 'User updated successfully!');
    }
}
