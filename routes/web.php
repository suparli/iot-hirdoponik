<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontrolController;
use App\Http\Controllers\LoggingController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::redirect('/', '/kontrol');


// Kontrol
Route::get('/kontrol', [KontrolController::class ,'index'])->name('kontrol');
Route::post('/kontrol', [KontrolController::class ,'update'])->name('kontrol.update');

// Logging
Route::get('/logging', [LoggingController::class ,'index'])->name('logging');

Route::middleware('apikey')->group(function () {
    Route::get('/api/logging', [LoggingController::class ,'device'])->name('logging.device');
    Route::get('/api/kontrol', [KontrolController::class ,'device'])->name('kontrol.device');
});


