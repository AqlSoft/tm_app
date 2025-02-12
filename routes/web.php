<?php

use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ProjectController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

// تغيير اللغة
Route::get('lang/{locale}', [LocalizationController::class, 'setLang'])->name('locale');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin-login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/password/request', [AuthController::class, 'passwordRequest'])->name('password-request');
    Route::post('/password/reset', [AuthController::class, 'passwordReset'])->name('password-reset');
});

Route::middleware('auth')->prefix('admin')->name('admin-')->group( function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard.home');
    })->name('dashboard');

    Route::prefix('tasks')->name('tasks-')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('create', [TaskController::class, 'create'])->name('create');
        Route::post('store', [TaskController::class, 'store'])->name('store');
        Route::get('{task}', [TaskController::class, 'show'])->name('show');
        Route::get('{task}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::put('{task}', [TaskController::class, 'update'])->name('update');
        Route::delete('{task}', [TaskController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('projects')->name('projects-')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('create', [ProjectController::class, 'create'])->name('create');
        Route::post('store', [ProjectController::class, 'store'])->name('store');
        Route::get('{project}', [ProjectController::class, 'show'])->name('show');
        Route::get('{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('{project}', [ProjectController::class, 'update'])->name('update');
        Route::delete('{project}', [ProjectController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('roles')->name('roles-')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/', [RoleController::class, 'index'])->name('roles-index');
        Route::get('create', [RoleController::class, 'create'])->name('roles-create');
        Route::post('store', [RoleController::class, 'store'])->name('roles-store');
        Route::get('{role}', [RoleController::class, 'show'])->name('roles-show');
        Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles-edit');
        Route::put('{role}', [RoleController::class, 'update'])->name('roles-update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('roles-destroy');
    });
    
});
