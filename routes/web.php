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
    Route::get('/dashboard', [\App\Http\Controllers\Authentication\Authcontroller::class, 'UserCount'])->name('dashboard');
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



use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/manage-users', function () {
    return view('users.manage-users');
})->name('users.manage-users');

Route::get('/manage-users', [UserController::class, 'manageUsers'])->name('users.manage-users');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


