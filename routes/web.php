<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProfileController;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $imagePath = DB::table('site_settings')->where('key', 'hero_image')->value('value');
    $projectsBackgroundPath = DB::table('site_settings')->where('key', 'projects_background')->value('value');

    return view('welcome', [
        'heroImage' => $imagePath ? Storage::disk('public')->url($imagePath) : null,
        'projectsBackgroundImage' => $projectsBackgroundPath ? Storage::disk('public')->url($projectsBackgroundPath) : null,
        'services' => Service::query()->orderBy('sort_order')->orderBy('id')->get(),
        'projects' => Project::query()->orderBy('sort_order')->orderBy('id')->get(),
        'portfolios' => Portfolio::query()->orderBy('sort_order')->orderBy('id')->get(),
    ]);
});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/admin/login', [AdminAuthController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('admin.login.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/hero-image', [AdminProfileController::class, 'updateHeroImage'])
        ->name('profile.hero-image.update');
    Route::delete('/hero-image', [AdminProfileController::class, 'destroyHeroImage'])
        ->name('profile.hero-image.destroy');
    Route::put('/projects-background', [AdminProfileController::class, 'updateProjectsBackground'])
        ->name('profile.projects-background.update');
    Route::post('/services', [AdminProfileController::class, 'storeService'])->name('services.store');
    Route::put('/services/{service}', [AdminProfileController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{service}', [AdminProfileController::class, 'destroyService'])->name('services.destroy');
    Route::post('/projects', [AdminProfileController::class, 'storeProject'])->name('projects.store');
    Route::put('/projects/{project}', [AdminProfileController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{project}', [AdminProfileController::class, 'destroyProject'])->name('projects.destroy');
    Route::post('/portfolios', [AdminProfileController::class, 'storePortfolio'])->name('portfolios.store');
    Route::put('/portfolios/{portfolio}', [AdminProfileController::class, 'updatePortfolio'])->name('portfolios.update');
    Route::delete('/portfolios/{portfolio}', [AdminProfileController::class, 'destroyPortfolio'])->name('portfolios.destroy');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
});
