<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::middleware('api')
    ->prefix('product')
    ->group(function () {
        Route::get('/detail', [ProductController::class, 'getProductDetails']);
    });