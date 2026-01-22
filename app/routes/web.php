<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PortfolioController as WebPortfolioController;
use App\Http\Controllers\Web\PricingController;
use App\Http\Controllers\Web\ResumeController as WebResumeController;
use App\Http\Controllers\Web\ShareController;
use App\Http\Controllers\Web\TemplateController as WebTemplateController;
use App\Http\Controllers\Web\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [UserDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Public pages
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/templates', [WebTemplateController::class, 'index'])->name('templates.index');
Route::get('/portfolios/{slug}', [ShareController::class, 'portfolio'])->name('portfolio.public');
Route::get('/resume/share/{token}', [ShareController::class, 'resume'])->name('resume.share');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resumes (web)
    Route::resource('resumes', WebResumeController::class);
    Route::post('resumes/{resume}/duplicate', [WebResumeController::class, 'duplicate'])->name('resumes.duplicate');
    Route::post('resumes/{resume}/publish', [WebResumeController::class, 'publish'])->name('resumes.publish');
    Route::post('resumes/{resume}/unpublish', [WebResumeController::class, 'unpublish'])->name('resumes.unpublish');
    Route::post('resumes/{resume}/export', [WebResumeController::class, 'export'])->name('resumes.export');

    // Portfolios (web)
    Route::resource('portfolios', WebPortfolioController::class);
    Route::post('portfolios/{portfolio}/publish', [WebPortfolioController::class, 'publish'])->name('portfolios.publish');
    Route::post('portfolios/{portfolio}/unpublish', [WebPortfolioController::class, 'unpublish'])->name('portfolios.unpublish');

    // Pricing checkout (web -> uses API/payment service)
    Route::post('/pricing/checkout', [PricingController::class, 'checkout'])->name('pricing.checkout');
});

require __DIR__.'/auth.php';
