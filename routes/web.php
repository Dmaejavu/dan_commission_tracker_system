<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\UnitManagerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\OwnerCommissionController;
use Illuminate\Http\Request;
use App\Models\Card;

// Default route for login
Route::get('/', function () {
    return view('auth.login'); 
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User management routes (bypassing authentication for creating users)
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

// Other routes requiring authentication
Route::middleware(['auth'])->group(function () {
    // Admin dashboard
    Route::get('/dashboardadmin', [AdminController::class, 'dashboard'])->name('dashboardadmin');

    // Unit Manager dashboard
    Route::get('/dashboardunitmanager', [UnitManagerController::class, 'dashboard'])->name('dashboardunitmanager'); 

    // Owner dashboard
    Route::get('/dashboardowner', [OwnerController::class, 'dashboard'])->name('dashboardowner');
    Route::get('/view-commissions', [OwnerController::class, 'viewCommissions'])->name('viewCommissions');
    Route::get('/total-commissions', [OwnerController::class, 'viewTotalCommissions'])->name('totalCommissions');
    Route::get('/manage-users', [OwnerController::class, 'manageUsers'])->name('manageUser');
    Route::get('/manage-agents', [OwnerController::class, 'manageAgents'])->name('manageAgent');
    Route::get('/create-commission', [OwnerCommissionController::class, 'createCommission'])->name('create_commission');

    // Commission 
    Route::get('/commissions/create', [CommissionController::class, 'create'])->name('commissions.create');
    Route::post('/commissions', [CommissionController::class, 'store'])->name('commissions.store');
    Route::get('/commissions/{commission}/edit', [CommissionController::class, 'edit'])->name('commissions.edit'); 
    Route::put('/commissions/{commission}', [CommissionController::class, 'update'])->name('commissions.update');
    Route::get('/commissions', [CommissionController::class, 'index'])->name('commissions.index');

    // User management routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('edit_users');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Agent 
    Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
    Route::post('/agents', [AgentController::class, 'store'])->name('agents.store');
    Route::get('/agents/{agent}/edit', [AgentController::class, 'edit'])->name('agents.edit'); 
    Route::put('/agents/{agent}', [AgentController::class, 'update'])->name('agents.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/owner/commissions', [OwnerCommissionController::class, 'store'])->name('owner.commissions.store');
    Route::get('/owner/commissions/{commission}/edit', [OwnerCommissionController::class, 'edit'])->name('owner.commissions.edit');
    Route::put('/owner/commissions/{commission}', [OwnerCommissionController::class, 'update'])->name('owner.commissions.update');
});

Route::get('/get-card-price', function (Request $request) {
    $card = Card::where('banktype', $request->banktype)
                ->where('cardtype', $request->cardtype)
                ->first();

    if ($card) {
        return response()->json(['price' => $card->prices]);
    }

    return response()->json(['price' => 0], 404);
});
