<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WinnerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backend.dashboard');
})->name('dashboard');

Route::prefix('product')->controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products');
    Route::put('/toggle/{id}', 'toggle')->name('products.toggle'); // ✅ use DELETE and pass ID
    Route::get('/create', 'create')->name('products.add');
    Route::post('/store', 'store')->name('products.store');
    Route::get('/edit/{id}', 'edit')->name('products.edit');
    Route::put('/update/{id}', 'update')->name('products.update'); // ✅ use PUT and pass ID
    Route::delete('/delete/{id}', 'destroy')->name('products.delete'); // ✅ use DELETE and pass ID
});

Route::prefix('participations')->controller(ParticipantController::class)->group(function () {
    Route::get('/', 'index')->name('participate');
    Route::get('/view/{id}', 'view')->name('participate.view');
    Route::delete('/delete/{id}', 'destroy')->name('participate.delete');
});

Route::prefix('winners')->controller(WinnerController::class)->group(function () {
    Route::get('/', 'index')->name('winners');
});