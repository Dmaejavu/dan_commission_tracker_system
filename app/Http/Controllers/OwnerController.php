<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use App\Models\Commission;

class OwnerController extends Controller
{
    public function dashboard()
    {
        // Fetch all users
        $users = User::all();

        // Fetch all agents
        $agents = Agent::with('commissions')->get();

        // Fetch all commissions with related user, agent, and card data
        $commissions = Commission::with('user', 'agent', 'card')->get();

        // Pass the data to the view
        return view('owner.dashboardowner', compact('users', 'agents', 'commissions'));
    }

    public function updateCommissionStatus(Request $request)
    {
        $request->validate([
            'commissionID' => 'required|exists:commissions,comID',
            'status' => 'required|in:Approved,Rejected,Canceled',
        ]);

        $commission = Commission::findOrFail($request->commissionID);
        $commission->status = $request->status;
        $commission->save();

        return redirect()->route('owner.dashboardowner')->with('success', 'Commission status updated successfully!');
    }
}