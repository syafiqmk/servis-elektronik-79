<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// HomePage Route
Route::get('/', [GeneralController::class, 'home']);

// Development Route
Route::get('/dev/dashboard', [DevController::class, 'dashboard']);

// Dashboard Route
Route::get('/dashboard', [GeneralController::class, 'dashboard'])->name('dashboard');

// Device Category Route
Route::name('category.')->controller(CategoryController::class)->group(function() {
    Route::get('/category', 'index')->name('index');
    Route::get('/category/create', 'create')->name('create');
    Route::post('/category/create', 'store')->name('store');
    Route::get('/category/edit/{category}', 'edit')->name('edit');
    Route::put('/category/edit/{category}/update', 'update')->name('update');
    Route::delete('/category/delete/{category}', 'destroy')->name('delete');
});

// User Account Route
Route::name('user.')->controller(UserController::class)->group(function() {
    Route::get('/user', 'index')->name('index');
    Route::get('/user/create', 'create')->name('create');
    Route::post('/user/create', 'store')->name('store');
    Route::get('/user/edit/{user}', 'edit')->name('edit');
    Route::put('/user/edit/{user}/detail', 'update_detail')->name('updateDetail');
    Route::put('/user/edit/{user}/password', 'update_password')->name('updatePassword');
    Route::delete('/user/delete{user}', 'destroy')->name('delete');
});

// Device Route
Route::name('device.')->controller(DeviceController::class)->group(function() {
    Route::get('/device', 'index')->name('index');
    Route::get('/device/create', 'create')->name('create');
    Route::post('/device/create', 'store')->name('store');
    Route::get('/device/{device}', 'show')->name('show');
    Route::put('/device/{device}/price', 'price_update')->name('updatePrice');
    Route::delete('/device/{device}/delete', 'destroy')->name('destroy');
});

// Transaction Route
Route::name('transaction.')->controller(TransactionController::class)->group(function() {
    Route::get('/transaction/{device}', 'create')->name('create');
    Route::post('/transaction/{device}', 'store')->name('store');
    Route::delete('/transaction/{transaction}/{device}/delete', 'destroy')->name('destroy');
});