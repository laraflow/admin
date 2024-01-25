<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "API" middleware group. Enjoy building your API!
|
*/
if (Config::get('skeleton.enabled')) {
    Route::prefix('skeleton')->name('skeleton.')->group(function () {
        Route::get('/', function () {
            return \Inertia\Inertia::render('index');
        });

        //DO NOT REMOVE THIS LINE//
    });
}
