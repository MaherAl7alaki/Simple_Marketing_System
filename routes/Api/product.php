<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('products', [ProductController::class, 'getProducts']);
    Route::get('products/marketingPage/{marketingPageId}', [ProductController::class, 'getMarketingPageProducts']);
    Route::get('product/{productId}', [ProductController::class, 'getProduct']);
    Route::post('product/create', [ProductController::class, 'createProduct']);
    Route::post('product/update/{productId}', [ProductController::class, 'updateProduct']);
    Route::post('product/delete/{productId}', [ProductController::class, 'destroy']);
});
