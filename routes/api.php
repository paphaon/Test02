<?php

use App\Http\Controllers\ProductController;

Route::get('/get/product', [ProductController::class, 'getProductDetail']);

