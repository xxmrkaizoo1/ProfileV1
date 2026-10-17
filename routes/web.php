<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProfileController;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $imagePath = DB::table('site_settings')->where('key', 'hero_image')->value('value');

    return view('welcome', [
        'heroImage' => $imagePath ? Storage::disk('public')->url($imagePath) : null,
        'services' => Service::query()->orderBy('sort_order')->orderBy('id')->get(),
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
    Route::post('/services', [AdminProfileController::class, 'storeService'])->name('services.store');
    Route::put('/services/{service}', [AdminProfileController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{service}', [AdminProfileController::class, 'destroyService'])->name('services.destroy');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
});
