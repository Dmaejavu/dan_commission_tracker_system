<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Support\Facades\Auth;

class UnitManagerController extends Controller
{
    public function dashboard()
    {  
        // Check if the user is an UnitManager
        if (!Auth::check() || Auth::user()->position !== 'UnitManager') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        // Fetch all commissions with related user and agent data
        $commissions = Commission::with('user', 'agent')->get();

        return view('unitmanager.dashboardunitmanager', compact('commissions'));
    }
}
