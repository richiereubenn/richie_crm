<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    if(auth()->check()){
        $user = auth()->user();
        if ($user->role === 'Admin') return redirect()->route('users.index');
        if ($user->role === 'Manager') return redirect()->route('projects.index');
        if ($user->role === 'Sales') return redirect()->route('leads.index');
        return redirect('/login'); 
    }
    return redirect('/login');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::middleware('role:Admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::resource('products', ProductController::class);

    Route::resource('leads', LeadController::class);

    Route::resource('projects', ProjectController::class);
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{project}/approve', [ProjectController::class, 'approve'])
        ->name('projects.approve');
    Route::post('/projects/{project}/reject', [ProjectController::class, 'reject'])
        ->name('projects.reject');

    Route::resource('customers', CustomerController::class);

    Route::post('/customers/{customer}/pay', [CustomerController::class, 'pay'])
        ->name('customers.pay');
});
