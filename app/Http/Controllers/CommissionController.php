<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'agentID' => 'required|exists:agents,agentID',
            'totalcom' => 'required|numeric',
            'clientname' => 'required|string|max:50',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to create a commission.']);
        }

        // Create a new commission
        Commission::create([
            'userID' => $user->userID,
            'agentID' => $request->agentID,
            'totalcom' => $request->totalcom,
            'clientname' => $request->clientname,
            'status' => 'Pending',
        ]);

        return redirect()->route('dashboardadmin')->with('success', 'Commission created successfully!');
    }

    public function edit(Commission $commission)
    {
        return view('commissions.edit', compact('commission'));
    }

    public function update(Request $request, Commission $commission)
    {
        $request->validate([
            'totalcom' => 'required|numeric',
            'clientname' => 'required|string|max:50',
            'status' => 'required|in:Pending,Approved,Rejected,Canceled',
        ]);

        $commission->update([
            'totalcom' => $request->totalcom,
            'clientname' => $request->clientname,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboardowner')->with('success', 'Commission updated successfully!');
    }
}