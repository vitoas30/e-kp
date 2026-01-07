<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PositionCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $bestEmployees = \App\Models\User::whereHas('roles', function($q) {
            $q->where('name', '!=', 'admin');
        })
        ->with('position') // Eager load position for display
        ->withCount(['tasks as completed_ontime_count' => function ($query) {
             $query->where('status', 'completed')
                   ->whereMonth('updated_at', now()->month)
                   ->whereYear('updated_at', now()->year)
                   ->whereRaw('DATE(updated_at) <= due_date');
        }])
        ->orderByDesc('completed_ontime_count')
        ->take(3)
        ->get();

    return view('welcome', compact('bestEmployees'));
});

Route::get('/panduan', function () {
    return view('panduan');
})->name('panduan');

Route::get('/fitur-utama', function () {
    return view('fitur_utama');
})->name('fitur-utama');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/kontak-it', function () {
    return view('kontak_it');
})->name('kontak-it');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');

Route::post('/attendance/checkin', [App\Http\Controllers\AttendanceController::class, 'store'])->name('attendance.checkin')->middleware('auth');
Route::post('/attendance/checkout', [App\Http\Controllers\AttendanceController::class, 'update'])->name('attendance.checkout')->middleware('auth');
Route::post('/attendance/permission', [App\Http\Controllers\AttendanceController::class, 'storePermission'])->name('attendance.permission')->middleware('auth');
// Route::get('/login', [ProfileController::class, 'edit'])->name('profile.edit');

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('index');
        Route::get('/setting', [App\Http\Controllers\User\ProfileController::class, 'setting'])->name('setting');
        Route::get('/security', [App\Http\Controllers\User\ProfileController::class, 'security'])->name('security');
        Route::get('/task', [App\Http\Controllers\User\ProfileController::class, 'task'])->name('task');
    });
    
    // Notifications
    Route::post('/notifications/mark-read', [App\Http\Controllers\User\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/{id}/read', [App\Http\Controllers\User\NotificationController::class, 'read'])->name('notifications.read');
    Route::get('/notifications/check', [App\Http\Controllers\User\NotificationController::class, 'check'])->name('notifications.check');

    // Project
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\ProjectController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\User\ProjectController::class, 'store'])->name('store');
        Route::post('/{id}', [App\Http\Controllers\User\ProjectController::class, 'update'])->name('update');
        Route::post('/update/status/{id}', [App\Http\Controllers\User\ProjectController::class, 'updateStatus'])->name('update-status');
        Route::get('/{id}', [App\Http\Controllers\User\ProjectController::class, 'destroy'])->name('destroy');
    });
    
    // Task
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/{id}', [App\Http\Controllers\User\TaskController::class, 'index'])->name('index');
        Route::get('/my-task/{id}', [App\Http\Controllers\User\TaskController::class, 'myTask'])->name('my-task');
        Route::post('/', [App\Http\Controllers\User\TaskController::class, 'store'])->name('store');
        Route::post('/{id}', [App\Http\Controllers\User\TaskController::class, 'update'])->name('update');
        Route::post('/update/status/{id}', [App\Http\Controllers\User\TaskController::class, 'updateStatus'])->name('update-status');
        Route::get('/delete/{id}', [App\Http\Controllers\User\TaskController::class, 'destroy'])->name('destroy');
    });

    // Inventory User
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\InventoryController::class, 'index'])->name('index');
        Route::post('/service', [App\Http\Controllers\User\InventoryController::class, 'storeServiceRequest'])->name('service.store');
        Route::post('/service/{id}/complete', [App\Http\Controllers\User\InventoryController::class, 'completeService'])->name('service.complete');
        
        // Privileged Management Routes
        Route::post('/item', [App\Http\Controllers\User\InventoryController::class, 'storeItem'])->name('items.store');
        Route::post('/item/{id}', [App\Http\Controllers\User\InventoryController::class, 'updateItem'])->name('items.update');
        Route::delete('/item/{id}', [App\Http\Controllers\User\InventoryController::class, 'destroyItem'])->name('items.destroy');
        Route::post('/service/{id}/update', [App\Http\Controllers\User\InventoryController::class, 'updateServiceStatus'])->name('services.update');
    });

    // Attendance History
    Route::get('/attendance', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/store', [App\Http\Controllers\AttendanceController::class, 'storeManual'])->name('attendance.storeManual');
    Route::put('/attendance/{id}', [App\Http\Controllers\AttendanceController::class, 'updateRecord'])->name('attendance.update');
    Route::delete('/attendance/{id}', [App\Http\Controllers\AttendanceController::class, 'destroy'])->name('attendance.destroy');
    
    // Overtime
    Route::prefix('overtime')->name('overtime.')->group(function () {
        Route::get('/', [App\Http\Controllers\User\OvertimeController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\User\OvertimeController::class, 'store'])->name('store');
        Route::delete('/{id}', [App\Http\Controllers\User\OvertimeController::class, 'destroy'])->name('destroy');
    });
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Menu
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\MenuController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\MenuController::class, 'store'])->name('store');
        Route::post('/{id}', [App\Http\Controllers\Admin\MenuController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('destroy');
    });
    
    // Permission
    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('store');
        Route::post('/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('destroy');
    });

    // User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('store');
        Route::get('/show/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
        // Change Password
        Route::get('/change-password/{id}', [App\Http\Controllers\Admin\UserController::class, 'password'])->name('change.password');
        Route::post('/change-password/{id}', [App\Http\Controllers\Admin\UserController::class, 'updatePassword'])->name('change.password.update');

        Route::get('/employee/{id}', [App\Http\Controllers\Admin\UserController::class, 'employee'])->name('employee');
        Route::post('/employee/type/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateEmployeeType'])->name('employee.type');
        Route::post('/employee/type/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateEmployeeTypeUpdate'])->name('employee.type.update');
        Route::get('/employee/type/destroy/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroyEmployeeType'])->name('employee.type.destroy');
        // Allowance Info
        Route::get('/allowance/{id}', [App\Http\Controllers\Admin\UserController::class, 'allowance'])->name('allowance');
        Route::post('/allowance/add/{id}', [App\Http\Controllers\Admin\UserController::class, 'addAllowance'])->name('allowance.add');
        Route::post('/allowance/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'updateAllowance'])->name('allowance.update');
        Route::get('/allowance/destroy/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroyAllowance'])->name('allowance.destroy');
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

    // Project
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [App\Http\Controllers\ProjectController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\ProjectController::class, 'store'])->name('store');
        Route::get('/show/{id}', [App\Http\Controllers\ProjectController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [App\Http\Controllers\ProjectController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('destroy');
    });
    
    // Task
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [App\Http\Controllers\TaskController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\TaskController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\TaskController::class, 'store'])->name('store');
        Route::get('/show/{id}', [App\Http\Controllers\TaskController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('destroy');
    });

    // Item
    Route::prefix('items')->name('items.')->group(function () {
        Route::get('/category', [App\Http\Controllers\Admin\CategoryItemController::class, 'index'])->name('category.index');
        Route::post('/category', [App\Http\Controllers\Admin\CategoryItemController::class, 'store'])->name('category.store');
        Route::post('/category/update/{id}', [App\Http\Controllers\Admin\CategoryItemController::class, 'update'])->name('category.update');
        Route::get('/category/{id}', [App\Http\Controllers\Admin\CategoryItemController::class, 'destroy'])->name('category.destroy');
    });

    // Inventory
    Route::prefix('inventory')->name('inventory.')->group(function () {
        // Items
        Route::get('/items', [App\Http\Controllers\Admin\InventoryItemController::class, 'index'])->name('items.index');
        Route::post('/items', [App\Http\Controllers\Admin\InventoryItemController::class, 'store'])->name('items.store');
        Route::post('/items/{id}', [App\Http\Controllers\Admin\InventoryItemController::class, 'update'])->name('items.update');
        Route::get('/items/{id}', [App\Http\Controllers\Admin\InventoryItemController::class, 'destroy'])->name('items.destroy');
        
        // Services
        Route::get('/services', [App\Http\Controllers\Admin\InventoryServiceController::class, 'index'])->name('services.index');
        Route::post('/services/{id}', [App\Http\Controllers\Admin\InventoryServiceController::class, 'update'])->name('services.update');
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

    // Attendance
    Route::get('/attendance', [App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [App\Http\Controllers\Admin\AttendanceController::class, 'store'])->name('attendance.store');
    
    Route::put('/attendance/{id}', [App\Http\Controllers\Admin\AttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{id}', [App\Http\Controllers\Admin\AttendanceController::class, 'destroy'])->name('attendance.destroy');

    // Overtime
    Route::prefix('overtime')->name('overtime.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\OvertimeController::class, 'index'])->name('index');
        Route::post('/', [App\Http\Controllers\Admin\OvertimeController::class, 'store'])->name('store');
        Route::put('/{id}', [App\Http\Controllers\Admin\OvertimeController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\OvertimeController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
