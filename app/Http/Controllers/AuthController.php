<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            switch ($user->position) {
                case 'Admin':
                    return redirect('/dashboardadmin');
                case 'Owner':
                    return redirect('/dashboardowner');
                case 'UnitManager':
                    return redirect('/dashboardunitmanager');
                default:
                    return back()->withErrors(['login' => 'Invalid role.']);
            }
        }

        return back()->withErrors(['login' => 'Invalid username or password.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}