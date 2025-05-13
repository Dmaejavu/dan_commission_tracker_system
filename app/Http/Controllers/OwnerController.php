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

        // Total commissions where status is 'Approved'
        $totalCommissions = Commission::where('status', 'Approved')->sum('totalcom');

        // Top agent based on approved commissions
        $topAgent = Agent::withSum(['commissions as approved_commissions' => function ($query) {
            $query->where('status', 'Approved');
        }], 'totalcom')
        ->orderByDesc('approved_commissions')
        ->first();

        // Total agents
        $totalAgents = Agent::count();

        // Recent pending commissions
        $recentPendingCommissions = Commission::where('status', 'Pending')->latest()->take(10)->get();

        return view('owner.dashboardowner', compact(
            'totalCommissions',
            'topAgent',
            'totalAgents',
            'recentPendingCommissions'
        ));
    }

    public function viewCommissions()
    {
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

        $commissions = Commission::with(['user', 'agent', 'card'])->get();
        return view('owner.view_commissions', compact('commissions'));
    }

    public function viewTotalCommissions()
    {
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }

    // Load agents with approved commissions
    $agents = Agent::with('approvedCommissions')->get();

    return view('owner.total_commissions', compact('agents'));
    }

    public function manageUsers()
    {
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
        $users = User::where('position', '!=', 'Owner')->get();
        return view('owner.users', compact('users'));
    }

    public function manageAgents()
    {
    if (!Auth::check() || Auth::user()->position !== 'Owner') {
        Auth::logout(); // Destroy the session
        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
        $agents = Agent::all();
        return view('owner.agents', compact('agents'));
    }

    public function createCommission()
    {
if (!Auth::check() || Auth::user()->position !== 'Owner') {
    Auth::logout(); // Destroy the session
    return redirect()->route('login')->with('error', 'Unauthorized access.');
}

        $agents = Agent::all(); // Fetch all agents
        return view('owner.create_commission', compact('agents'));
    }
}