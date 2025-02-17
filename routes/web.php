<?php

use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
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

    Route::prefix('users')->group(function () {
        Route::get('/list', [UserController::class, 'index'])->name('users-index');
        Route::get('create', [UserController::class, 'create'])->name('users-create');
        Route::post('store', [UserController::class, 'store'])->name('users-store');
        Route::get('{user}', [UserController::class, 'show'])->name('users-show');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('users-edit');
        Route::put('{user}', [UserController::class, 'update'])->name('users-update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('users-destroy');
    });
    
    Route::prefix('roles')->name('roles-')->group(function () {
        Route::get('/list', [RoleController::class, 'index'])->name('index');
        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::post('store', [RoleController::class, 'store'])->name('store');
        Route::get('{role}', [RoleController::class, 'show'])->name('show');
        Route::get('{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::put('update/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('{role}', [RoleController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('permissions')->name('permissions-')->group(function () {
        Route::get('/list', [PermissionController::class, 'index'])->name('index');
        Route::get('create', [PermissionController::class, 'create'])->name('create');
        Route::post('store', [PermissionController::class, 'store'])->name('store');
        Route::get('{permission}', [PermissionController::class, 'show'])->name('show');
        Route::get('{permission}/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::put('update/{permission}', [PermissionController::class, 'update'])->name('update');
        Route::delete('{permission}', [PermissionController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('clients')->name('clients-')->group(function () {
        Route::get('/list', [ClientController::class, 'index'])->name('index');
        Route::get('create', [ClientController::class, 'create'])->name('create');
        Route::post('store', [ClientController::class, 'store'])->name('store');
        Route::get('{client}', [ClientController::class, 'show'])->name('show');
        Route::get('{client}/edit', [ClientController::class, 'edit'])->name('edit');
        Route::put('update/{client}', [ClientController::class, 'update'])->name('update');
        Route::delete('{client}', [ClientController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('payments')->name('payments-')->group(function () {
        Route::get('/list', [PaymentController::class, 'index'])->name('index');
        Route::get('create', [PaymentController::class, 'create'])->name('create');
        Route::post('store', [PaymentController::class, 'store'])->name('store');
        Route::get('{payment}', [PaymentController::class, 'show'])->name('show');
        Route::get('{payment}/edit', [PaymentController::class, 'edit'])->name('edit');
        Route::put('{payment}', [PaymentController::class, 'update'])->name('update');
        Route::delete('{payment}', [PaymentController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('projects')->name('projects-')->group(function () {
        Route::get('/list', [ProjectController::class, 'index'])->name('index');
        Route::get('create', [ProjectController::class, 'create'])->name('create');
        Route::post('store', [ProjectController::class, 'store'])->name('store');
        Route::get('{project}', [ProjectController::class, 'show'])->name('show');
        Route::get('{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('{project}', [ProjectController::class, 'update'])->name('update');
        Route::delete('{project}', [ProjectController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('invoices')->name('invoices-')->group(function () {
        Route::get('/list', [InvoiceController::class, 'index'])->name('index');
        Route::get('create', [InvoiceController::class, 'create'])->name('create');
        Route::post('store', [InvoiceController::class, 'store'])->name('store');
        Route::get('{invoice}', [InvoiceController::class, 'show'])->name('show');
        Route::get('{invoice}/edit', [InvoiceController::class, 'edit'])->name('edit');
        Route::put('{invoice}', [InvoiceController::class, 'update'])->name('update');
        Route::delete('{invoice}', [InvoiceController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('notes')->name('notes-')->group(function () {
        Route::get('/list', [NoteController::class, 'index'])->name('index');
        Route::get('create', [NoteController::class, 'create'])->name('create');
        Route::post('store', [NoteController::class, 'store'])->name('store');
        Route::get('{note}', [NoteController::class, 'show'])->name('show');
        Route::get('{note}/edit', [NoteController::class, 'edit'])->name('edit');
        Route::put('{note}', [NoteController::class, 'update'])->name('update');
        Route::delete('{note}', [NoteController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('teams')->name('teams-')->group(function () {
        Route::get('/list', [TeamController::class, 'index'])->name('index');
        Route::get('create', [TeamController::class, 'create'])->name('create');
        Route::post('store', [TeamController::class, 'store'])->name('store');
        Route::get('{team}', [TeamController::class, 'show'])->name('show');
        Route::get('{team}/edit', [TeamController::class, 'edit'])->name('edit');
        Route::put('{team}', [TeamController::class, 'update'])->name('update');
        Route::delete('{team}', [TeamController::class, 'destroy'])->name('destroy');
        
        Route::post('add/member', [TeamController::class, 'add_member'])->name('add-member');
        
    });

    
});
