<?php

use App\Http\Controllers\Api\AIController;
use App\Http\Controllers\Api\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\Admin\PlanController as AdminPlanController;
use App\Http\Controllers\Api\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Api\Admin\TemplateController as AdminTemplateController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\PortfolioPublicController;
use App\Http\Controllers\Api\ResumeController;
use App\Http\Controllers\Api\ResumeShareController;
use App\Http\Controllers\Api\ResumeTemplateController;
use App\Http\Controllers\Api\WebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('auth/reset-password', [AuthController::class, 'resetPassword']);

    Route::get('templates', [ResumeTemplateController::class, 'index']);
    Route::get('plans', [PaymentController::class, 'plans']);
    Route::get('share/resumes/{token}', [ResumeShareController::class, 'show'])->name('share.resume');
    Route::get('portfolios/public/{slug}', [PortfolioPublicController::class, 'show']);

    Route::post('payments/webhooks/stripe', [WebhookController::class, 'handleStripe']);
    Route::post('payments/webhooks/paypal', [WebhookController::class, 'handlePayPal']);

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('auth/logout', [AuthController::class, 'logout']);
        Route::get('auth/me', [AuthController::class, 'me']);
        Route::put('auth/profile', [AuthController::class, 'updateProfile']);
        Route::put('auth/preferences', [AuthController::class, 'updatePreferences']);

        Route::apiResource('resumes', ResumeController::class);
        Route::post('resumes/{resume}/duplicate', [ResumeController::class, 'duplicate']);
        Route::post('resumes/{resume}/publish', [ResumeController::class, 'publish']);
        Route::post('resumes/{resume}/unpublish', [ResumeController::class, 'unpublish']);
        Route::post('resumes/{resume}/export', [ResumeController::class, 'exportPdf']);
        Route::get('resumes/{resume}/completeness', [ResumeController::class, 'completeness']);

        Route::apiResource('portfolios', PortfolioController::class);
        Route::post('portfolios/{portfolio}/publish', [PortfolioController::class, 'publish']);
        Route::post('portfolios/{portfolio}/unpublish', [PortfolioController::class, 'unpublish']);

        Route::post('ai/cover-letter', [AIController::class, 'generateCoverLetter']);

        Route::post('payments/checkout', [PaymentController::class, 'checkout']);
        Route::get('payments/history', [PaymentController::class, 'history']);
        Route::get('subscriptions/current', [PaymentController::class, 'currentSubscription']);

        Route::middleware('admin')->prefix('admin')->group(function (): void {
            Route::get('dashboard', [AdminDashboardController::class, 'stats']);
            Route::apiResource('templates', AdminTemplateController::class);
            Route::apiResource('plans', AdminPlanController::class);
            Route::apiResource('users', AdminUserController::class)->only(['index', 'show', 'update']);
            Route::get('settings', [AdminSettingController::class, 'index']);
            Route::put('settings', [AdminSettingController::class, 'update']);
        });
    });
});
