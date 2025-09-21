<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventsController;

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

    Route::prefix('committees')->group(function() {
        Route::get('/', [CommitteeController::class, 'index'])->name('committees');
        Route::get('/create', [CommitteeController::class, 'create'])->name('committees.create');
        Route::post('/', [CommitteeController::class, 'store'])->name('committees.store');
        Route::get('/edit/{id}', [CommitteeController::class, 'edit'])->name('committees.edit');
        Route::put('/{id}', [CommitteeController::class, 'update'])->name('committees.update');
        Route::delete('/{id}', [CommitteeController::class, 'destroy'])->name('committees.destroy');
    });


    Route::prefix('courses')->group(function() {
        Route::get('/', [CourseController::class, 'index'])->name('courses');
        Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/update/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });

    Route::prefix('events')->group(function() {
        Route::get('/', [EventsController::class, 'index'])->name('events');
        Route::get('/create', [EventsController::class, 'create'])->name('events.create');
        Route::post('/', [EventsController::class, 'store'])->name('events.store');
        Route::get('/edit/{id}', [EventsController::class, 'edit'])->name('events.edit');
        Route::put('/update/{id}', [EventsController::class, 'update'])->name('events.update');
        Route::delete('/{id}', [EventsController::class, 'destroy'])->name('events.destroy');
    });
});
