<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\EconomyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RiskController;

Route::get('/', [DashboardController::class, 'index']);

Route::get('/countries', [CountryController::class, 'index'])
    ->name('countries.index');
Route::post('/countries/import', [CountryController::class, 'import'])
    ->name('countries.import');
Route::resource('ports', PortController::class);
Route::post('/ports/import', [PortController::class, 'import'])
    ->name('ports.import');
Route::get('/weather', [WeatherController::class, 'index'])
    ->name('weather.index');
Route::get('/economy', [EconomyController::class, 'index'])
    ->name('economy.index');
Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/risk', [RiskController::class, 'index'])
    ->name('risk.index');