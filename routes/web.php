<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');

    Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');

    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');

    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');

    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');

    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
});





Route::middleware('auth')->group(function () {

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
});




Route::middleware('auth')->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');

    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');

    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});


require __DIR__ . '/auth.php';
