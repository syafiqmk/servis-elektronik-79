<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DevController;
use App\Http\Controllers\GeneralController;
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
});