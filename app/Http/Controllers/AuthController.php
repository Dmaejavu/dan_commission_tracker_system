<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Log;
use App\Models\User; 
use App\Mail\VerificationCodeMail; 

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
                'login' => "Too many login attempts. Please try again later.",
            ]);
        }
        if (Auth::attempt($request->only('username', 'password'))) {
            RateLimiter::clear($key); 

            $user = Auth::user();

            //Log the login
            Log::create([
                'userID' => $user->userID,
                'action' => 'login',
                'model' => 'User',
                'model_id' => $user->userID,
                'description' => $user->username . ' logged in successfully. ',
                'old_values' => null, 
                'new_values' => null, 
            ]);

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
        $user = Auth::user();
        //Log the login
            Log::create([
                'userID' => $user->userID,
                'action' => 'login',
                'model' => 'User',
                'model_id' => $user->userID,
                'description' => $user->username . ' logged out successfully. ',
                'old_values' => null, 
                'new_values' => null, 
            ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function forgotPassEmailVerify(Request $request)
    {
    $request->validate([
        'username' => 'required|string|exists:users,username'
    ]);

    $user = User::where('username', $request->username)->first();

    $code = rand(100000, 999999);

    DB::table('password_resets')->updateOrInsert(
        ['email' => $user->email],
        [
            'token' => Hash::make($code),
            'created_at' => now()
        ]
    );

    Mail::to($user->email)->send(new VerificationCodeMail($code));

    return view('auth.forgotPassSubmit', [
        'email' => $user->email
        ]);
    }

    public function showNewPassForm(Request $request)
    {
        $email = $request->query('email') ?? session('email');
        return view('auth.forgotPassNewPass', ['email' => $email]);
    }

    public function resetPasswordCode(Request $request){ 
        $passCodeRecords = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();
        
        //This for invalid code
        if (!$passCodeRecords){
            return back()->withErrors(['code' => 'Invalid code']); 
        }

        //This for incorrect code
        if (!Hash::check($request->code, $passCodeRecords->token)){
            return back()->withErrors(['code' => 'Incorrect code']); 
        }

        //This for expiration code
        if (now()->diffInMinutes($passCodeRecords->created_at) > 10){
            return back()->withErrors(['code' => 'Code Expired']); 
        }

        //Delete code verification after 
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete(); 

        return redirect()->route('forgotPassNewPass', ['email' => $request->email]);
    }

    public function passwordReset(Request $request) {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email', 
                'password' => 'required|min:3|confirmed',
            ]
        );

        // fetch user by email and update using the User model
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // optional: add a log entry
        Log::create([
            'userID' => $user->userID,
            'action' => 'password_reset',
            'model' => 'User',
            'model_id' => $user->userID,
            'description' => $user->username . ' reset their password.',
            'old_values' => null,
            'new_values' => null,
        ]);

        return redirect()->route('login')->with('status', 'Your password has been updated. Please log in with the new password.');
    }
}