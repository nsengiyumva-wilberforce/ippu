<?php

use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\EducationBackgroundController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CpdsController;




Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});


//Cpds API resource routes with auth middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cpds', CpdsController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('education-background', EducationBackgroundController::class);
    Route::get('upcoming-cpds', [CpdsController::class, 'upcoming']);
    Route::get('attended-cpds', [CpdsController::class, 'attended']);
    Route::get('upcoming-events', [EventController::class, 'upcoming']);
    Route::get('attended-events', [EventController::class, 'attended']);
});
