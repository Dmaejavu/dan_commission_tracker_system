<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import the trait
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests; // Include the trait

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'position' => 'required|in:Admin,UnitManager', // Only Admin and UnitManager are allowed
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password
            'position' => $request->position,
        ]);

        return redirect()->route('dashboardowner')->with('success', 'User created successfully!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $this->authorize('edit', $user); // Use the 'edit' policy

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in the database.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user); // Use the 'update' policy

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->userID . ',userID',
            'password' => 'nullable|string|min:6', // Password is optional
            'position' => 'required|in:Admin,UnitManager', // Only Admin and UnitManager are allowed
        ]);

        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash the new password
        }
        $user->position = $request->position;
        $user->save();

        return redirect()->route('dashboardowner')->with('success', 'User updated successfully!');
    }
}
