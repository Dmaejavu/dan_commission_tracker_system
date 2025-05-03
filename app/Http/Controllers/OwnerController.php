<?php
namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $commissions = Commission::with('user', 'agent')->get();
        $users = User::whereIn('position', ['Admin', 'UnitManager'])->get();
        $agents = Agent::with('commissions')->get();

        return view('owner.dashboardowner', compact('commissions', 'users', 'agents'));
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