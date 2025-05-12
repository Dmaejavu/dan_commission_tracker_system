<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\Commission;
use App\Models\Agent;

class AdminController extends Controller
{
    public function dashboard()
    {  // Check if the user is an admin
        if (!Auth::check() || Auth::user()->position !== 'Admin') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        // Fetch distinct bank types and card types from the cards table
        $banktypes = Card::select('banktype')->distinct()->pluck('banktype');
        $cardtypes = Card::select('cardtype')->distinct()->pluck('cardtype');

        // Fetch all agents
        $agents = Agent::all();

        // Fetch all commissions with related user, agent, and card data
        $commissions = Commission::with('user', 'agent', 'card')->get();

        // Pass the data to the view
        return view('admin.dashboardadmin', compact('banktypes', 'cardtypes', 'agents', 'commissions'));
    }
}