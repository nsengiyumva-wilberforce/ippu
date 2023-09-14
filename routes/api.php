<?php

use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\EducationBackgroundController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\WorkExperienceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CpdsController;
use App\Http\Controllers\API\AccountTypeController;
use App\Http\Controllers\API\JobsController;
use App\Http\Controllers\API\CommunicationController;

//routes for authentication
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});
Route::apiResource('account-types', AccountTypeController::class)->only(['index', 'show']);
Route::get('education-background/{userId}', [EducationBackgroundController::class, 'index']);
Route::post('education-background', [EducationBackgroundController::class, 'store']);
Route::get('work-experience/{userId}', [WorkExperienceController::class, 'index']);
Route::post('work-experience', [WorkExperienceController::class, 'store']);

//cpds routes
Route::apiResource('cpds', CpdsController::class);
Route::get('upcoming-cpds', [CpdsController::class, 'upcoming']);
Route::get('attended-cpds/{id}', [CpdsController::class, 'attended']);
Route::post('cpds/attend', [CpdsController::class, 'confirm_attendence']);
Route::get('cpds/certificate/{userId}/{cpdId}', [CpdsController::class, 'certificate']);

//events routes
Route::get('upcoming-events', [EventController::class, 'upcoming']);
Route::get('attended-events/{id}', [EventController::class, 'attended']);
//Route::apiResource('events', EventController::class);
Route::get('events/{userId}', [EventController::class, 'index']);
Route::post('attend-event', [EventController::class, 'confirm_attendence']);
Route::get('events/certificate/{userId}/{eventId}', [EventController::class, 'certificate']);


//jobs routes
Route::apiResource('jobs', JobsController::class)->only(['index', 'show']);

//profile routes
Route::apiResource('profile', ProfileController::class)->only(['update', 'show']);

//communication routes
Route::apiResource('communications', CommunicationController::class);
