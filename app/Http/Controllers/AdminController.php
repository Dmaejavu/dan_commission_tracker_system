<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Commission;
use App\Models\Agent;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch distinct bank types and card types from the cards table
        $banktypes = Card::select('banktype')->distinct()->pluck('banktype');
        $cardtypes = Card::select('cardtype')->distinct()->pluck('cardtype');

        // Fetch all agents
        $agents = Agent::all();

        // Fetch all commissions with related data
        $commissions = Commission::with('user', 'agent', 'card')->get();

        // Pass the data to the view
        return view('admin.dashboardadmin', compact('banktypes', 'cardtypes', 'agents', 'commissions'));
    }
}