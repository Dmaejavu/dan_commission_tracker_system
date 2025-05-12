<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthController extends Controller
{
    use ValidatesRequests;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $key = 'login-attempts:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            RateLimiter::hit($key, 300); //TIMER

            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'login' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }
        if (Auth::attempt($request->only('username', 'password'))) {
            RateLimiter::clear($key); 

            $user = Auth::user();
            switch ($user->position) {
                case 'Admin':
                    return redirect()->route('dashboardadmin'); // Admin dashboard
                case 'Owner':
                    return redirect()->route('dashboardowner'); // Owner dashboard
                case 'UnitManager':
                    return redirect()->route('dashboardunitmanager'); // Unit Manager dashboard
                default:
                    return back()->withErrors(['login' => 'Invalid role.']);
            }
        }
        RateLimiter::hit($key, 300); 

        throw ValidationException::withMessages([
            'login' => 'The provided credentials are incorrect.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}