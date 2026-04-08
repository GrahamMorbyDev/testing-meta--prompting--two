<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/shopping', [ShoppingItemController::class, 'index'])->name('shopping.index');
    Route::post('/shopping', [ShoppingItemController::class, 'store'])->name('shopping.store');
    Route::delete('/shopping/{shoppingItem}', [ShoppingItemController::class, 'destroy'])->name('shopping.destroy');
});
