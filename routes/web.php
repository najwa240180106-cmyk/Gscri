<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\EconomyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RiskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Semua User Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');

    Route::get('/ports', [PortController::class, 'index'])->name('ports.index');

    Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');

    Route::get('/economy', [EconomyController::class, 'index'])->name('economy.index');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');

    Route::get('/risk', [RiskController::class, 'index'])->name('risk.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function () {

    // Countries
    Route::post('/countries/import', [CountryController::class, 'import'])->name('countries.import');
    Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
    Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');
    Route::get('/countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');
    Route::put('/countries/{country}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('/countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');
    Route::get('/countries/{country}', [CountryController::class, 'show'])->name('countries.show');
    
    // Ports
    Route::post('/ports/import', [PortController::class, 'import'])->name('ports.import');
    Route::get('/ports/create', [PortController::class, 'create'])->name('ports.create');
    Route::post('/ports', [PortController::class, 'store'])->name('ports.store');
    Route::get('/ports/{port}/edit', [PortController::class, 'edit'])->name('ports.edit');
    Route::put('/ports/{port}', [PortController::class, 'update'])->name('ports.update');
    Route::delete('/ports/{port}', [PortController::class, 'destroy'])->name('ports.destroy');
    Route::get('/ports/{port}', [PortController::class, 'show'])->name('ports.show');

    // Economy
    Route::post('/economy/update', [EconomyController::class, 'updateApi']) ->name('economy.update');

    // Weather
    Route::post('/weather/update', [WeatherController::class, 'updateApi'])->name('weather.update');

    Route::post('/news/update', [NewsController::class, 'updateApi'])->name('news.update');
    // Risk
    Route::post('/risk/update', [RiskController::class, 'updateApi'])->name('risk.update');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.role');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

});

require __DIR__.'/auth.php';
