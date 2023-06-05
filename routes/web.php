<?php

use App\Http\Controllers\AuthController;
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
Route::get('/', [GeneralController::class, 'home'])->name('home');
Route::get('/403', [GeneralController::class, 'forbidden'])->name('403');

// Development Route
Route::get('/dev/dashboard', [DevController::class, 'dashboard']);

// Auth route
Route::name('auth.')->controller(AuthController::class)->group(function() {
    Route::middleware('guest')->group(function() {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginAttempt')->name('attempt');
    });
    Route::post('/logout', 'logout')->name('logout');
});

// Auth middleware
Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [GeneralController::class, 'dashboard'])->name('dashboard');
    
    // IsAdmin middleware
    Route::middleware('IsAdmin')->group(function () {
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
    });

    // Account setting route
    Route::name('user.')->controller(UserController::class)->group(function() {
        Route::get('/user/setting', 'setting')->name('setting');
        Route::put('/user/setting/{user}/detail', 'accDet')->name('accDet');
        Route::put('/user/setting/{user}/password', 'accPass')->name('accPass');
    });
    
    // Device Route
    Route::name('device.')->controller(DeviceController::class)->group(function() {
        Route::get('/device', 'index')->name('index');
        Route::get('/device/create', 'create')->name('create');
        Route::post('/device/create', 'store')->name('store');
        Route::get('/device/{device}', 'show')->name('show');
        Route::get('/device/{device}/edit', 'edit')->name('edit');
        Route::put('/device/{device}/edit', 'update')->name('update');
        Route::put('/device/{device}/price', 'price_update')->name('updatePrice');
        Route::delete('/device/{device}/delete', 'destroy')->name('destroy');
    });
    
    // Transaction Route
    Route::name('transaction.')->controller(TransactionController::class)->group(function() {
        Route::get('/transaction/{device}', 'create')->name('create');
        Route::post('/transaction/{device}', 'store')->name('store');
        Route::delete('/transaction/{transaction}/{device}/delete', 'destroy')->name('destroy');
    });
});
