<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenverificationMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/user_registration', [UserController::class, 'UserRegistration']);

Route::post('/user_login',[UserController::class,'UserLogin']);

Route::get('/user_logout',[UserController::class,'UserLogout']);

Route::post('/user_sendotp',[UserController::class,'SendOtpCode']);

Route::post('/user_verify',[UserController::class,'VerifyOtp']);

// Token verification
Route::get('/user-profile',[UserController::class,'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update',[UserController::class,'UpdateProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user_ResetPassword',[UserController::class,'ResetPassword'])
->middleware([TokenverificationMiddleware::class]);
