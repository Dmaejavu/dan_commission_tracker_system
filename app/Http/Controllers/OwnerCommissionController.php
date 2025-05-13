<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commission;
use App\Models\Card;
use App\Models\Agent;

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
            'totalcom' => 'required|numeric',
            'banktype' => 'required',
            'cardtype' => 'required',
            'agentID' => 'required|exists:agents,agentID',
        ]);

        // Create or retrieve the card
        $card = Card::firstOrCreate(
            ['banktype' => $request->banktype, 'cardtype' => $request->cardtype],
            ['cardID' => Card::max('cardID') + 1]
        );

        // Create the commission
        Commission::create([
            'clientname' => $request->clientname,
            'totalcom' => $request->totalcom,
            'status' => 'Pending',
            'cardID' => $card->cardID,
            'agentID' => $request->agentID,
            'userID' => Auth::id(),
        ]);

        return redirect()->route('viewCommissions')->with('success', 'Commission created successfully!');
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

        $commission->update([
            'totalcom' => $request->totalcom,
            'clientname' => $request->clientname,
            'status' => $request->status,
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
