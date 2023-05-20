<?php

use App\Http\Controllers\DevController;
use App\Http\Controllers\GeneralController;
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