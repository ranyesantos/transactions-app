<?php

use App\Http\Controllers\API\v1\CategoryController;
use App\Http\Controllers\API\v1\TransactionController;
use Illuminate\Support\Facades\Route;

Route::controller(TransactionController::class)->group(function() {
    Route::get('/transactions', 'index')->name('transactions.index');
    Route::post('/transactions', 'store')->name('transactions.store');
    Route::get('/transactions/{transaction}', 'show')->name('transactions.show');
    Route::put('/transactions/{transaction}', 'update')->name('transactions.update');
    Route::delete('/transactions/{transaction}', 'destroy')->name('transactions.destroy');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('categories', 'index')->name('categories.index');
    Route::post('categories', 'store')->name('categories.store');
    Route::get('categories/{category}', 'show')->name('categories.show');
});
