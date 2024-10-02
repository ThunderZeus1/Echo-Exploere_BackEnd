<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TourismController; // For managing tourism companies and packages
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Authentication\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Admin Dashboard with user count
    Route::get('/dashboard', [AuthController::class, 'UserCount'])->name('dashboard');

    // Bookings Routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

    // Other Routes
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/support', [SupportController::class, 'index'])->name('support.index');

    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/manage-users', [UserController::class, 'manageUsers'])->name('users.manage-users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Tourism Company and Tour Packages Routes
    Route::get('/tours', [TourismController::class, 'index'])->name('tours.index');

    // Tourism Company CRUD
    Route::post('/tours/company', [TourismController::class, 'storeCompany'])->name('tours.company.store');
    Route::put('/tours/company/{company}', [TourismController::class, 'updateCompany'])->name('tours.company.update');
    Route::delete('/tours/company/{company}', [TourismController::class, 'deleteCompany'])->name('tours.company.delete');

    // Tour Package CRUD
    Route::post('/tours/package', [TourismController::class, 'storePackage'])->name('tours.package.store');
    Route::put('/tours/package/{package}', [TourismController::class, 'updatePackage'])->name('tours.package.update');
    Route::delete('/tours/package/{package}', [TourismController::class, 'deletePackage'])->name('tours.package.delete');


    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');


});
