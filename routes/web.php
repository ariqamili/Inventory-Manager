<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::middleware(['business.access'])->group(function () {
        
        Route::middleware(['role:manager'])->group(function () {
            Route::resource('products', ProductController::class)->except(['index', 'show']);
            Route::resource('categories', CategoryController::class);
            Route::resource('users', UserController::class);
        });

        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
        
        Route::get('/products/{product}/sell', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/products/{product}/sell', [TransactionController::class, 'store'])->name('transactions.store');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';