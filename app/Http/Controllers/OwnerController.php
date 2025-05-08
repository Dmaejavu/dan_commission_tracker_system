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
        $users = User::where('position', '!=', 'Owner')->get(); // Exclude users with the Owner role
        $commissions = Commission::all();
        $agents = Agent::all();

        return view('owner.dashboardowner', compact('users', 'commissions', 'agents'));
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