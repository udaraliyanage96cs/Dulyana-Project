<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    
    Route::prefix('branches')->group(function() {
        Route::get('/', [BranchController::class, 'index'])->name('branches');
        Route::get('/create', [BranchController::class, 'create'])->name('branches.create');
        Route::post('/', [BranchController::class, 'store'])->name('branches.store');
        Route::get('/edit/{id}', [BranchController::class, 'edit'])->name('branches.edit');
        Route::put('/{id}', [BranchController::class, 'update'])->name('branches.update');
        Route::delete('/{id}', [BranchController::class, 'destroy'])->name('branches.destroy');
    });
});
