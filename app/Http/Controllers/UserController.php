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
        try {
            $request->validate([
                'username' => 'required|string|max:50|unique:users,username',
                'password' => 'required|string|min:6',
                'position' => 'required|in:Admin,UnitManager',
            ]);

            User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'position' => $request->position,
            ]);

            // Redirect to the users page with a success message
            return redirect()->route('users.index')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create user.');
        }
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
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'username' => 'required|string|max:50|unique:users,username,' . $user->userID . ',userID',
                'position' => 'required|in:Admin,UnitManager',
                'password' => 'nullable|string|min:6', // Password is optional but must be at least 6 characters if provided
            ]);
            $user->username = $request->username;
            $user->position = $request->position;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            // Redirect to the users page with a success message
            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update user.');
        }
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
