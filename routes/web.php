<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\UnitManagerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboardadmin', [AdminController::class, 'dashboard'])->name('dashboardadmin');
    Route::post('/commissions', [CommissionController::class, 'store'])->name('commissions.store');
    Route::get('/dashboardunitmanager', [UnitManagerController::class, 'dashboard'])->name('dashboardunitmanager');
    Route::get('/dashboardowner', [OwnerController::class, 'dashboard'])->name('dashboardowner');
    Route::post('/commissions/update-status', [OwnerController::class, 'updateCommissionStatus'])->name('commissions.updateStatus');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::post('/agents', [AgentController::class, 'store'])->name('agents.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/agents/{agent}/edit', [AgentController::class, 'edit'])->name('agents.edit');
    Route::put('/agents/{agent}', [AgentController::class, 'update'])->name('agents.update');
    Route::get('/commissions/{commission}/edit', [CommissionController::class, 'edit'])->name('commissions.edit');
    Route::put('/commissions/{commission}', [CommissionController::class, 'update'])->name('commissions.update');
});
