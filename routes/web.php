<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\UnitManagerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;

// Default route for login
Route::get('/', function () {
    return view('auth.login'); 
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Admin dashboard
    Route::get('/dashboardadmin', [AdminController::class, 'dashboard'])->name('dashboardadmin');

    // Unit Manager dashboard
    Route::get('/dashboardunitmanager', [UnitManagerController::class, 'dashboard'])->name('dashboardunitmanager'); 

    // Owner dashboard
    Route::get('/dashboardowner', [OwnerController::class, 'dashboard'])->name('dashboardowner');

    // Commission 
    Route::get('/commissions/create', [CommissionController::class, 'create'])->name('commissions.create');
    Route::post('/commissions', [CommissionController::class, 'store'])->name('commissions.store');
    Route::get('/commissions/{commission}/edit', [CommissionController::class, 'edit'])->name('commissions.edit'); 
    Route::put('/commissions/{commission}', [CommissionController::class, 'update'])->name('commissions.update');

    // User 
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); 
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Agent 
    Route::post('/agents', [AgentController::class, 'store'])->name('agents.store');
    Route::get('/agents/{agent}/edit', [AgentController::class, 'edit'])->name('agents.edit'); 
    Route::put('/agents/{agent}', [AgentController::class, 'update'])->name('agents.update');
});
