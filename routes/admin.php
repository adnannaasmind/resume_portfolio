<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Api\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Api\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Api\Admin\TemplateController as AdminTemplateController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here are all the admin/backend routes for your application. These routes
| are loaded by the RouteServiceProvider and are protected by the 'admin'
| middleware to ensure only administrators can access them.
|
*/

// Admin Authentication Routes (Public - for login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        // Admin Login Page
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // Admin Logout (Protected)
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

// Web-based Admin Routes (for views/pages)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard (Admin Web Interface)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');

    // Template Management
    Route::get('/templates', [AdminController::class, 'templates'])->name('templates');

    // Pricing Plans Management
    Route::get('/plans', [AdminController::class, 'plans'])->name('plans');

    // System Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// API-based Admin Routes (for backend operations)
Route::middleware(['auth:sanctum', 'admin'])->prefix('api/v1/admin')->name('api.admin.')->group(function () {
    // Dashboard Statistics & Analytics
    Route::get('/dashboard', [AdminDashboardController::class, 'stats'])->name('dashboard.stats');

    // Template Management API
    Route::apiResource('templates', AdminTemplateController::class);

    // Pricing Plans Management API
    Route::apiResource('plans', AdminPlanController::class);

    // User Management API (limited to index, show, update)
    Route::apiResource('users', AdminUserController::class)->only(['index', 'show', 'update']);

    // System Settings API
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
