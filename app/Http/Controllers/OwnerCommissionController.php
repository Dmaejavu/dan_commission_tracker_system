<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commission;
use App\Models\Card;
use App\Models\Agent;
use App\Models\Log;

class OwnerCommissionController extends Controller
{
    public function store(Request $request)
    {
        // Check if the user is an Owner
        if (!Auth::check() || Auth::user()->position !== 'Owner') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'clientname' => 'required|string|max:50',
            'banktype' => 'required',
            'cardtype' => 'required',
            'agentID' => 'required|exists:agents,agentID',
            'status' => 'required|in:Pending,Approved', 
        ]);

        // Retrieve the card price based on banktype and cardtype
        $card = Card::where('banktype', $request->banktype)
                    ->where('cardtype', $request->cardtype)
                    ->first();

        if (!$card) {
            return redirect()->back()->with('error', 'Invalid card type or bank type selected.');
        }

        // Create the commission
        $commission = Commission::create([
            'clientname' => $request->clientname,
            'totalcom' => $card->prices, 
            'status' => $request->status, 
            'cardID' => $card->cardID,
            'agentID' => $request->agentID,
            'userID' => Auth::id(),
        ]);

        // Log create comms
        Log::create([
            'userID' => Auth::id(),
            'action' => 'created_commission',
            'model' => 'Commission',
            'model_id' => $commission->comID,
            'description' => 'created commission for ' . $request->clientname . ' with ' . $request->banktype . ' ' . $request->cardtype . ' card, amount ₱' . $card->prices . '.',
            'new_values' => json_encode([
                'clientname' => $request->clientname,
                'banktype' => $request->banktype,
                'cardtype' => $request->cardtype,
                'totalcom' => $card->prices,
                'status' => $request->status,
            ])
        ]);

        return redirect()->route('create_commission')->with('success', 'Commission created successfully!');
    }

    public function edit(Commission $commission)
    {

        if (!Auth::check() || Auth::user()->position !== 'Owner') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        return view('owner.edit_commission', compact('commission'));
    }

    public function update(Request $request, Commission $commission)
    {
        if (!Auth::check() || Auth::user()->position !== 'Owner') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'totalcom' => 'required|numeric',
            'clientname' => 'required|string|max:50',
            'status' => 'required|in:Pending,Approved,Rejected,Canceled',
        ]);

        // Store old values before updating
        $oldValues = [
            'totalcom' => $commission->totalcom,
            'clientname' => $commission->clientname,
            'status' => $commission->status,
        ];

        $commission->update([
            'totalcom' => $request->totalcom,
            'clientname' => $request->clientname,
            'status' => $request->status,
        ]);

        // Log update comms
        $actionType = $request->status === 'Approved' ? 'approved_commission' : 'updated_commission';
        Log::create([
            'userID' => Auth::id(),
            'action' => $actionType,
            'model' => 'Commission',
            'model_id' => $commission->comID,
            'description' => 'commission ' . $commission->comID . ' status changed to ' . $request->status . '.',
            'old_values' => json_encode($oldValues),
            'new_values' => json_encode([
                'totalcom' => $request->totalcom,
                'clientname' => $request->clientname,
                'status' => $request->status,
            ])
        ]);

        return redirect()->route('viewCommissions')->with('success', 'Commission updated successfully!');
    }

    public function createCommission()
    {
        $agents = Agent::all(); 
        $banktypes = Card::select('banktype')->distinct()->pluck('banktype'); 
        $cardtypes = Card::select('cardtype')->distinct()->pluck('cardtype'); 

        return view('owner.create_commission', compact('agents', 'banktypes', 'cardtypes'));
    }
}
