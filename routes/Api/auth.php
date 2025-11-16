<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarketingPageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','verify-email'])->group(function () {

    Route::post('/reset/password',[AuthController::class,'resetPassword']);
    Route::post('logout', [AuthController::class, 'logout']);
});
//Route::post('MarketingPage/create', [MarketingPageController::class, 'createMarketingPage'])->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login',[AuthController::class,'login']);


Route::post('forgetPassword',[AuthController::class,'forgetPassword']);
Route::post('email/verification',[AuthController::class,'emailVerification'])->middleware(['throttle:3,1','auth:sanctum']);
Route::get('resend/verificationCode',[AuthController::class,'resendVerificationCode'])->middleware(['throttle:1,1','auth:sanctum']);
