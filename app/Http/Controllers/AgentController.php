<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function store(Request $request)
    {
        // Check if the user is an Owner
        if (!Auth::check() || Auth::user()->position !== 'Owner') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        try {
            $request->validate([
                'agentname' => 'required|string|max:50',
                'comrate' => 'required|numeric|min:1|max:100',
                'area' => 'required|string',
            ]);

            Agent::create([
            'agentname' => $request->agentname,
            'comrate' => $request->comrate / 100, // Convert percentage to decimal
            'area' => $request->area,
        ]);

            // Redirect to the agents page with a success message
            return redirect()->route('manageAgent')->with('success', 'Agent created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create agent.');
        }
    }

    public function edit(Agent $agent)
    {
        // Check if the user is an Owner
        if (!Auth::check() || Auth::user()->position !== 'Owner') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        // Convert the commission rate to a percentage for display
        $agent->comrate = $agent->comrate * 100;

        return view('owner.edit_agent', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        // Check if the user is an Owner
        if (!Auth::check() || Auth::user()->position !== 'Owner') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        try {
            $request->validate([
                'agentname' => 'required|string|max:50',
                'comrate' => 'required|numeric|min:1|max:100',
                'area' => 'required|string',
            ]);

        $agent->update([
            'agentname' => $request->agentname,
            'comrate' => $request->comrate / 100, // Convert percentage to decimal
            'area' => $request->area,
        ]);

            // Redirect to the agents page with a success message
            return redirect()->route('manageAgent')->with('success', 'Agent updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update agent.');
        }
    }

    public function index(Request $request)
    {
        $query = Agent::query();

        // Search by Agent Name
        if ($request->filled('search')) {
            $query->where('agentname', 'like', '%' . $request->search . '%');
        }

        // Filter by Area
        if ($request->filled('area')) {
            $query->where('area', $request->area);
        }

        // Fetch filtered agents
        $agents = $query->get();

        // Fetch distinct areas for the dropdown
        $areas = Agent::distinct()->pluck('area');

        return view('owner.agents', compact('agents', 'areas'));
    }

    public function create()
    {
        $areas = ['Davao', 'Samal', 'Cotabato', 'Mati']; // Enum values
        return view('owner.agents', compact('areas'));
    }
}
