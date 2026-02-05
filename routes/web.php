<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\MembreController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [AccueilController::class, 'home'])->name('home');

// Route::get('/about', [AccueilController::class, 'about'])->name('about');

// Route::get('/contact', [AccueilController::class, 'contact'])->name('contact');

// Route::get('/clear-cache', function () {
//     Artisan::call('config:clear');
//     Artisan::call('cache:clear');
//     Artisan::call('route:clear');
//     Artisan::call('view:clear');
//     return "Cache cleared!";
// });

// Route::get('/create', [ManagerController::class, 'create']);

Route::middleware(['guest:web'])->group(function () {
    Route::get('/login', [ManagerController::class, 'login'])->name('manager.login');
    Route::post('/login', [ManagerController::class, 'store'])->name('manager.store');
});

Route::middleware(['auth:auth-manager'])->group(function () {
    Route::get('/', [DashboardController::class, 'accueil'])->name('dashboard');

    Route::resource('membres', MembreController::class);

    Route::get('cotisations-show', [MembreController::class, 'showCotisation'])->name('cotisation.show');
    Route::post('cotisations-store', [MembreController::class, 'storeCotisation'])->name('cotisation.store');

    Route::post('/logout', [ManagerController::class, 'logout'])->name('admin.logout');
});
