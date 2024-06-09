<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

use App\Http\Controllers\BookingController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupportController;

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/statistics', [StatisticController::class, 'index'])->name('stats.index');
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::get('/support', [SupportController::class, 'index'])->name('support.index');
