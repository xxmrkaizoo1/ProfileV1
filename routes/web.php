<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $imagePath = DB::table('site_settings')->where('key', 'hero_image')->value('value');

    return view('welcome', [
        'heroImage' => $imagePath ? Storage::disk('public')->url($imagePath) : null,
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
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
});
