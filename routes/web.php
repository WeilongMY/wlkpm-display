<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('display');
});

Route::get('/config/display', [\App\Http\Controllers\DisplayController::class, 'index']);
Route::post('/config/upload', [\App\Http\Controllers\DisplayController::class, 'uploadImage'])->name('config.upload');
