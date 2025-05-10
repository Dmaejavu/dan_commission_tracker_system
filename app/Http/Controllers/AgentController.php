<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'agentname' => 'required|string|max:50',
            'comrate' => 'required|numeric|min:0|max:100', 
            'area' => 'required|string|max:50',
        ]);

        Agent::create([
            'agentname' => $request->agentname,
            'comrate' => $request->comrate / 100,
            'area' => $request->area,
        ]);

        return redirect()->route('dashboardowner')->with('success', 'Agent created successfully!');
    }

    public function edit(Agent $agent)
    {
        return view('agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        $request->validate([
            'agentname' => 'required|string|max:50',
            'comrate' => 'required|numeric|min:0|max:100',
            'area' => 'required|string|max:50',
        ]);

        $agent->update([
            'agentname' => $request->agentname,
            'comrate' => $request->comrate / 100,
            'area' => $request->area,
        ]);

        return redirect()->route('dashboardowner')->with('success', 'Agent updated successfully!');
    }
}
