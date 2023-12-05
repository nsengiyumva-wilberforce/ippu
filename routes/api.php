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
use App\Http\Controllers\API\UserFcmDeviceTokenController;

//routes for authentication
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout/{user}', 'logout');
});
Route::apiResource('account-types', AccountTypeController::class)->only(['index', 'show']);
Route::get('education-background/{userId}', [EducationBackgroundController::class, 'index']);
Route::put('edit-education-background', [EducationBackgroundController::class, 'update']);
Route::post('education-background', [EducationBackgroundController::class, 'store']);
Route::get('work-experience/{userId}', [WorkExperienceController::class, 'index']);
Route::put('edit-work-experience', [WorkExperienceController::class, 'update']);
Route::post('work-experience', [WorkExperienceController::class, 'store']);

//cpds routes
Route::get('cpds/{userId}', [CpdsController::class, 'index']);
Route::get('upcoming-cpds/{userId}', [CpdsController::class, 'upcoming']);
Route::get('attended-cpds/{id}', [CpdsController::class, 'attended']);
Route::post('cpds/attend', [CpdsController::class, 'confirm_attendence']);
Route::get('cpds/certificate/{userId}/{cpdId}', [CpdsController::class, 'certificate']);

//events routes
Route::get('upcoming-events/{userId}', [EventController::class, 'upcoming']);
Route::get('attended-events/{id}', [EventController::class, 'attended']);
Route::get('events/{userId}', [EventController::class, 'index']);
Route::post('attend-event', [EventController::class, 'confirm_attendence']);
Route::get('events/certificate/{userId}/{eventId}', [EventController::class, 'certificate']);


//jobs routes
Route::apiResource('jobs', JobsController::class)->only(['index', 'show']);

//profile routes
Route::apiResource('profile', ProfileController::class)->only(['index', 'update', 'show']);
Route::delete('profile/remove/{userId}', [ProfileController::class, 'delete_my_account']);
Route::post('profile/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('profile/verify-password-reset-email', [AuthController::class, 'verifyPasswordResetEmail']);
Route::post('profile/resend-verification-code', [AuthController::class, 'resendVerificationCode']);
Route::post('profile/reset-password-code', [AuthController::class, 'resetPasswordCode']);
Route::post('profile/reset-password', [AuthController::class, 'resetPassword']);
Route::post('update-profile-photo/{user}', [ProfileController::class, 'updateProfilePhoto']);
Route::post('subscribe', [ProfileController::class, 'subscribe']);

//communication routes
Route::get('communications/{userId}', [CommunicationController::class, 'index']);
Route::post('mark-as-read', [CommunicationController::class, 'markAsRead']);

//fcm device token routes
Route::post('fcm-device-token', [UserFcmDeviceTokenController::class, 'store']);
Route::post('send-notification', [UserFcmDeviceTokenController::class, 'sendNotification']);

