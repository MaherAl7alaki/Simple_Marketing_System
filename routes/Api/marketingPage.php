<?php

use App\Http\Controllers\MarketingPageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','verify-email'])->group(function () {
    Route::get('allMarketingPages', [MarketingPageController::class, 'getAllMarketingPages']);
    Route::get('marketingPage/{id}', [MarketingPageController::class, 'getMarketingPageDetails']);
    Route::get('myMarketingPages', [MarketingPageController::class, 'getMyMarketingPages']);
    Route::post('MarketingPage/create', [MarketingPageController::class, 'createMarketingPage']);
});
