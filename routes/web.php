<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/user_registration', [UserController::class, 'UserRegistration']);

Route::post('/user_login',[UserController::class,'UserLogin']);

Route::post('/user_sendotp',[UserController::class,'SendOtpCode']);

Route::post('/user_verify',[UserController::class,'VerifyOtp']);
