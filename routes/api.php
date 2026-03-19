<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\Api\ProductController as ApiProductController;

Route::get('/products', [ApiProductController::class, 'index']);
Route::get('/products/{product}', [ApiProductController::class, 'show']);

Route::get('/orders', [ApiOrderController::class, 'index']);
Route::get('/orders/{order}', [ApiOrderController::class, 'show']);

Route::post('/orders', [ApiOrderController::class, 'store']);
