<?php
namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Commission;

class AdminController extends Controller
{
    public function dashboard()
    {
        $agents = Agent::all(); // Fetch all agents
        $commissions = Commission::with('user', 'agent')->get(); // Fetch all commissions with relationships

        return view('dashboardadmin', compact('agents', 'commissions'));
    }
}