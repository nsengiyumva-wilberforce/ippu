<?php

use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\EducationBackgroundController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CpdsController;
use App\Http\Controllers\API\AccountTypeController;
use App\Http\Controllers\API\JobsController;

//routes for authentication
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});
Route::apiResource('account-types', AccountTypeController::class)->only(['index', 'show']);
Route::apiResource('education-background', EducationBackgroundController::class);

//cpds routes
Route::apiResource('cpds', CpdsController::class);
Route::get('upcoming-cpds', [CpdsController::class, 'upcoming']);
Route::get('attended-cpds', [CpdsController::class, 'attended']);

//events routes
Route::get('upcoming-events', [EventController::class, 'upcoming']);
Route::get('attended-events', [EventController::class, 'attended']);
Route::apiResource('events', EventController::class);


//jobs routes
Route::apiResource('jobs', JobsController::class)->only(['index', 'show']);
