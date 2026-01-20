<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ResumeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\UserController;
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

    // User Management - Full CRUD
    Route::resource('users', UserController::class);

    // My Resume - Full CRUD
    Route::resource('resumes', ResumeController::class);

    // Resume Sections Management
    Route::prefix('resumes/{resume}')->name('resumes.')->group(function () {
        // Experiences
        Route::post('experiences', [ResumeController::class, 'storeExperience'])->name('experiences.store');
        Route::put('experiences/{experience}', [ResumeController::class, 'updateExperience'])->name('experiences.update');
        Route::delete('experiences/{experience}', [ResumeController::class, 'deleteExperience'])->name('experiences.delete');

        // Education
        Route::post('educations', [ResumeController::class, 'storeEducation'])->name('educations.store');
        Route::put('educations/{education}', [ResumeController::class, 'updateEducation'])->name('educations.update');
        Route::delete('educations/{education}', [ResumeController::class, 'deleteEducation'])->name('educations.delete');

        // Skills
        Route::post('skills', [ResumeController::class, 'storeSkill'])->name('skills.store');
        Route::put('skills/{skill}', [ResumeController::class, 'updateSkill'])->name('skills.update');
        Route::delete('skills/{skill}', [ResumeController::class, 'deleteSkill'])->name('skills.delete');

        // Projects
        Route::post('projects', [ResumeController::class, 'storeProject'])->name('projects.store');
        Route::put('projects/{project}', [ResumeController::class, 'updateProject'])->name('projects.update');
        Route::delete('projects/{project}', [ResumeController::class, 'deleteProject'])->name('projects.delete');

        // Contact & About
        Route::put('contact', [ResumeController::class, 'updateContact'])->name('contact.update');
        Route::put('about', [ResumeController::class, 'updateAbout'])->name('about.update');
        Route::put('profile', [ResumeController::class, 'updateProfile'])->name('profile.update');
        Route::post('profile-image', [ResumeController::class, 'updateProfileImage'])->name('profile-image.update');

        // References
        Route::post('references', [ResumeController::class, 'storeReference'])->name('references.store');
        Route::put('references/{reference}', [ResumeController::class, 'updateReference'])->name('references.update');
        Route::delete('references/{reference}', [ResumeController::class, 'deleteReference'])->name('references.delete');

        // Achievements
        Route::post('achievements', [ResumeController::class, 'storeAchievement'])->name('achievements.store');
        Route::put('achievements/{achievement}', [ResumeController::class, 'updateAchievement'])->name('achievements.update');
        Route::delete('achievements/{achievement}', [ResumeController::class, 'deleteAchievement'])->name('achievements.delete');

        // Passions
        Route::post('passions', [ResumeController::class, 'storePassion'])->name('passions.store');
        Route::put('passions/{passion}', [ResumeController::class, 'updatePassion'])->name('passions.update');
        Route::delete('passions/{passion}', [ResumeController::class, 'deletePassion'])->name('passions.delete');

        // Highlights
        Route::post('highlights', [ResumeController::class, 'storeHighlight'])->name('highlights.store');
        Route::put('highlights/{highlight}', [ResumeController::class, 'updateHighlight'])->name('highlights.update');
        Route::delete('highlights/{highlight}', [ResumeController::class, 'deleteHighlight'])->name('highlights.delete');
    });


    // Template Management - Full CRUD
    Route::get('templates/{template}/preview', [TemplateController::class, 'preview'])->name('templates.preview');
    Route::post('templates/{template}/use', [TemplateController::class, 'useTemplate'])->name('templates.use');
    Route::resource('templates', TemplateController::class);

    // Pricing Plans Management - Full CRUD
    Route::resource('plans', PlanController::class);

    // Portfolio Templates - Full CRUD
    Route::resource('portfolio-templates', PortfolioController::class)->parameters([
        'portfolio-templates' => 'portfolio',
    ]);

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/payments', [ReportController::class, 'payments'])->name('payments');
        Route::get('/users', [ReportController::class, 'users'])->name('users');
    });

    // System Settings - Update operations
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/system', [SettingController::class, 'system'])->name('system');
        Route::post('/system', [SettingController::class, 'systemUpdate'])->name('system.update');

        Route::get('/smtp', [SettingController::class, 'smtp'])->name('smtp');
        Route::post('/smtp', [SettingController::class, 'smtpUpdate'])->name('smtp.update');

        Route::get('/payment', [SettingController::class, 'payment'])->name('payment');
        Route::post('/payment', [SettingController::class, 'paymentUpdate'])->name('payment.update');

        Route::get('/website', [SettingController::class, 'website'])->name('website');
        Route::post('/website', [SettingController::class, 'websiteUpdate'])->name('website.update');

        Route::get('/languages', [SettingController::class, 'languages'])->name('languages');
        Route::post('/languages', [SettingController::class, 'languagesUpdate'])->name('languages.update');

        Route::get('/seo', [SettingController::class, 'seo'])->name('seo');
        Route::post('/seo', [SettingController::class, 'seoUpdate'])->name('seo.update');

        Route::get('/about', [SettingController::class, 'about'])->name('about');
        Route::post('/about', [SettingController::class, 'aboutUpdate'])->name('about.update');
    });

    // Manage Profile
    Route::prefix('profile')->name('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::put('/', [ProfileController::class, 'update'])->name('.update');
        Route::post('/password', [ProfileController::class, 'passwordUpdate'])->name('.password.update');
        Route::post('/avatar', [ProfileController::class, 'avatarUpdate'])->name('.avatar.update');
    });
});
