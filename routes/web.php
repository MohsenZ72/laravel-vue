<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegisterController;
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

    Route::get('/', [LoginRegisterController::class, 'index'])->name('login');
    Route::post('/register', [LoginRegisterController::class, 'register']);
    Route::post('/login',[LoginRegisterController::class, 'login']);

    Route::post('/logout',[LoginRegisterController::class, 'logout']);

