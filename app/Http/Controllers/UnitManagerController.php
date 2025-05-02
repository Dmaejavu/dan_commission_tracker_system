<?php

namespace App\Http\Controllers;

use App\Models\Commission;

class UnitManagerController extends Controller
{
    public function dashboard()
    {
        // Fetch all commissions with related user and agent data
        $commissions = Commission::with('user', 'agent')->get();

        return view('dashboardunitmanager', compact('commissions'));
    }
}
