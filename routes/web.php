<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PositionCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');

// Route::get('/login', [ProfileController::class, 'edit'])->name('profile.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::get('/show/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
        // Employee Info
        Route::get('/employee/{id}', [App\Http\Controllers\Admin\UserController::class, 'employee'])->name('employee');
        Route::post('/employee/type/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateEmployeeType'])->name('employee.type');
        Route::post('/employee/type/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateEmployeeTypeUpdate'])->name('employee.type.update');
        // Allowance Info
        Route::get('/allowance/{id}', [App\Http\Controllers\Admin\UserController::class, 'allowance'])->name('allowance');
        Route::post('/allowance/type/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateAllowanceType'])->name('allowance.type');
        Route::post('/allowance/type/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateAllowanceTypeUpdate'])->name('allowance.type.update');
    });
    
    // Position Category
    Route::prefix('position-category')->name('position.category.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PositionCategoryController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\PositionCategoryController::class, 'store'])->name('store');
        Route::post('/{id}', [App\Http\Controllers\Admin\PositionCategoryController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Admin\PositionCategoryController::class, 'destroy'])->name('destroy');
    });
    
    // Position
    Route::prefix('position')->name('position.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PositionController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\PositionController::class, 'store'])->name('store');
        Route::post('/{id}', [App\Http\Controllers\Admin\PositionController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Admin\PositionController::class, 'destroy'])->name('destroy');
    });

    // Allowance
    Route::prefix('allowance')->name('allowance.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AllowanceController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\AllowanceController::class, 'store'])->name('store');
        Route::post('/{id}', [App\Http\Controllers\Admin\AllowanceController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Admin\AllowanceController::class, 'destroy'])->name('destroy');
    });

    // Employee Type
    Route::prefix('employee-type')->name('employee.type.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\EmployeeTypeController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\EmployeeTypeController::class, 'store'])->name('store');
        Route::post('/{id}', [App\Http\Controllers\Admin\EmployeeTypeController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Admin\EmployeeTypeController::class, 'destroy'])->name('destroy');
    });
    
    // Role Management
    Route::get('/roles', [AdminController::class, 'roles'])->name('roles.index');
    
    // Content Management (placeholder routes)
    Route::get('/posts', function () {
        return view('admin.posts.index');
    })->name('posts.index');
    
    Route::get('/categories', function () {
        return view('admin.categories.index');
    })->name('categories.index');
    
    // Settings & Reports
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});

require __DIR__.'/auth.php';
