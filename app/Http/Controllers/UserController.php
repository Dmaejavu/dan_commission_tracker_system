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
            'password' => 'required|string|min:3',
            'position' => 'required|in:Admin,UnitManager', // Only Admin and UnitManager are allowed
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password
            'position' => $request->position,
        ]);

        // Redirect to the users page with a success message
        return redirect()->route('manageUser')->with('success', 'User created successfully!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('owner.edit_users', compact('user'));
    }

    /**
     * Update the specified user in the database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->userID . ',userID',
            'password' => 'nullable|string|min:3', // Password is optional
            'position' => 'required|in:Admin,UnitManager', // Only Admin and UnitManager are allowed
        ]);

        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Hash the new password
        }
        $user->position = $request->position;
        $user->save();

        // Redirect to the users page with a success message
        return redirect()->route('manageUser')->with('success', 'User updated successfully!');
    }

    /**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search by Username
        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }

        // Exclude the Owner from the results
        $users = $query->where('position', '!=', 'Owner')->get();

        return view('owner.users', compact('users'));
    }
}
