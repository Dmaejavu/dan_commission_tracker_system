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
        $totalCommissions = \App\Models\Commission::sum('totalcom');
        $totalAgents = \App\Models\Agent::count();

        $topAgent = \App\Models\Agent::withSum('commissions', 'totalcom')
            ->orderByDesc('commissions_sum_totalcom')
            ->first();

        $recentPendingCommissions = \App\Models\Commission::where('status', 'Pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Fetch Commissions
        $commissions = \App\Models\Commission::with(['user', 'agent', 'card'])->get();

        // Fetch Users 
        $users = \App\Models\User::all();

        // Fetch Agents 
        $agents = \App\Models\Agent::all();

        return view('owner.dashboardowner', compact(
            'totalCommissions',
            'totalAgents',
            'topAgent',
            'recentPendingCommissions',
            'commissions',
            'users', 
            'agents' 
        ));
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

        return redirect()->route('dashboardowner')->with('success', 'Commission status updated successfully!');
    }
}