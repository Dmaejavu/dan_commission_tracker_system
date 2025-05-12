<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Commission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function dashboard()
    {
         // Check if the user is an Owner
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }


        $totalCommissions = Commission::sum('totalcom');
        $totalAgents = Agent::count();
        $topAgent = Agent::withSum('commissions', 'totalcom')
            ->orderByDesc('commissions_sum_totalcom')
            ->first();
        $recentPendingCommissions = Commission::where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('owner.dashboardowner', compact('totalCommissions', 'totalAgents', 'topAgent', 'recentPendingCommissions'));
    }

    public function viewCommissions()
    {
          // Check if the user is an Owner
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

        $commissions = Commission::with(['user', 'agent', 'card'])->get();
        return view('owner.view_commissions', compact('commissions'));
    }

    public function viewTotalCommissions()
    {
          // Check if the user is an Owner
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
        $agents = Agent::with('commissions')->get();
        return view('owner.total_commissions', compact('agents'));
    }

    public function manageUsers()
    {
          // Check if the user is an Owner
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
        $users = User::where('position', '!=', 'Owner')->get();
        return view('owner.users', compact('users'));
    }

    public function manageAgents()
    {
          // Check if the user is an Owner
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
        $agents = Agent::all();
        return view('owner.agents', compact('agents'));
    }

    public function createCommission()
    {
// Check if the user is an Owner
if (!Auth::check() || Auth::user()->position !== 'Owner') {
    Auth::logout(); // Destroy the session
    return redirect()->route('login')->with('error', 'Unauthorized access.');
}

        $agents = Agent::all(); // Fetch all agents
        return view('owner.create_commission', compact('agents'));
    }
}