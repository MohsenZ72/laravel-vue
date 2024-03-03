<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::resource('settings', SettingsController::class)->names('settings');

  });
