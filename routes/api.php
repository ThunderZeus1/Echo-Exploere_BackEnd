<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/Register',[
    \App\Http\Controllers\Authentication\Authcontroller::class,
    'CreateUser'
]);
Route::post('/Login',[
    \App\Http\Controllers\Authentication\Authcontroller::class,
    'LoginUser'
]);
