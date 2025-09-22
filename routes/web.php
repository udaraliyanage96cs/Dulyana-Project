<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    if(auth()->check()) {
        return redirect('/dashboard');
    }
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

        Route::get('/statistical-report/{id}', [BranchController::class, 'statisticalReport'])->name('branches.statistical-report');
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

    Route::prefix('members')->group(function() {
        Route::get('/', [MemberController::class, 'index'])->name('members');
        Route::get('/create', [MemberController::class, 'create'])->name('members.create');
        Route::post('/', [MemberController::class, 'store'])->name('members.store');
        Route::get('/edit/{id}', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('/update/{id}', [MemberController::class, 'update'])->name('members.update');
        Route::delete('/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
        
        Route::get('/remove-course/{memberId}/{courseId}', [MemberController::class, 'removeCourse'])->name('members.removeCourse');
        Route::get('/district_directories_report', [MemberController::class, 'district_directories_report'])->name('members.district_directories_report');
        Route::get('/{id}', [MemberController::class, 'show'])->name('members.show');
        Route::get('/remove-branch/{memberId}/{branchId}', [MemberController::class, 'removeBranch'])->name('members.removeBranch');
        Route::get('/card/{memberId}/{courseId}', [MemberController::class, 'card'])->name('members.card');
        Route::post('/card/{memberId}/{courseId}', [MemberController::class, 'card_update'])->name('members.card_update');
        Route::get('/committees-role/{memberId}/{branchId}', [MemberController::class, 'committees_role'])->name('members.committees_role');
        Route::post('/committees-role/{memberId}/{branchId}', [MemberController::class, 'committees_role_store'])->name('members.committees_role_store');
        Route::delete('/remove-committee/{committeeId}', [MemberController::class, 'removeCommittee'])->name('members.removeCommittee');

        Route::get('/anual_service_report/{id}', [MemberController::class, 'anual_service_report'])->name('members.anual_service_report');

    });
});
