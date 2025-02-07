<?php

use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\LocaleController;

Route::get('/locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale');
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/password/request', [AuthController::class, 'passwordRequest'])->name('password-request');
    Route::post('/password/reset', [AuthController::class, 'passwordReset'])->name('password-reset');
});

Route::middleware('auth')->prefix('admin')->name('admin-')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard.home');
    })->name('dashboard');

    Route::group([
        
        'prefix' => 'roles',
        'name' => 'roles-',
    ], function () {
        Route::resource('users', UserController::class);
        Route::resource('tasks', TaskController::class);
        Route::get('/', [RoleController::class, 'index'])->name('roles-index');
        Route::get('create', [RoleController::class, 'create'])->name('roles-create');
        Route::post('store', [RoleController::class, 'store'])->name('roles-store');
        Route::get('{role}', [RoleController::class, 'show'])->name('roles-show');
        Route::get('{role}/edit', [RoleController::class, 'edit'])->name('roles-edit');
        Route::put('{role}', [RoleController::class, 'update'])->name('roles-update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('roles-destroy');
    });
    
});
