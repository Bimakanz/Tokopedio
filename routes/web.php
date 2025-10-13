<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
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

Route::get('/seller', function () {
    return view('Seller.index');
});

// routes/web.php
Route::get('/User/create/{id}', [UserController::class, 'create'])->name('User.create');
Route::post('/User/store', [UserController::class, 'store'])->name('User.store');


Route::get('/User/create/{id}', [UserController::class, 'create'])->name('User.create');

// Orders list for authenticated user

Route::get('/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/forbiden', function () {
    return response()->view('forbiden', [], 403);
})->name('forbiden');

// use App\Http\Controllers\Seller\OrderController;

Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/order/{id}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});


Route::middleware('auth')->group(function () {
    Route::get('/pemesanan', [OrderController::class, 'index'])->name('User.index');
    Route::get('/pemesanan/{id}', [OrderController::class, 'show'])->name('User.show');
});

Route::middleware(['auth', 'role:Seller'])->group(function () {
    Route::resource('Seller', SellerController::class);
    Route::resource('Seller/produk', ProdukController::class);
});


require __DIR__ . '/auth.php';
