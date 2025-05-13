<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commission;
use App\Models\Card;

class CommissionController extends Controller
{
    public function store(Request $request)
    {
        // Check if the user is an Admin
        if (!Auth::check() || Auth::user()->position !== 'Admin') {
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

        //banktype and cardtype
        $card = Card::firstOrCreate(
            ['banktype' => $request->banktype, 'cardtype' => $request->cardtype],
            ['cardID' => Card::max('cardID') + 1]
        );

        // Create the commission
        Commission::create([
            'clientname' => $request->clientname,
            'totalcom' => $request->totalcom,
            'status' => 'Pending', // Default status
            'cardID' => $card->cardID,
            'agentID' => $request->agentID,
            'userID' => Auth::id(),
        ]);

        return redirect()->route('dashboardadmin')->with('success', 'Commission created successfully!');
    }

    public function edit(Commission $commission)
    {
        // Check if the user is an Owner
        if (!Auth::check() || Auth::user()->position !== 'Owner') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        return view('commissions.edit', compact('commission'));
    }

    public function update(Request $request, Commission $commission)
    {  // Check if the user is an Owner
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

        return redirect()->route('dashboardowner')->with('success', 'Commission updated successfully!');
    }

    public function create()
    {   // Check if the user is an Owner
        if (!Auth::check() || Auth::user()->position !== 'Admin') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        $banktypes = Card::select('banktype')->distinct()->pluck('banktype');
        $cardtypes = Card::select('cardtype')->distinct()->pluck('cardtype');

        return view('admin.create_commission', compact('banktypes', 'cardtypes'));
    }

    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->position !== 'Owner') {
            Auth::logout(); // Destroy the session
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
        $query = Commission::query();

        // Search by Agent Name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('agent', function ($q) use ($search) {
                $q->where('agentname', 'like', '%' . $search . '%');
            });
        }

        // Fetch commissions with related data
        $commissions = $query->with(['user', 'agent', 'card'])->get();

        return view('owner.view_commissions', compact('commissions'));
    }
}
