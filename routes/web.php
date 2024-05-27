<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\EmailController;

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

// routes/web.php
Route::get('/tokens', [ApiController::class, 'generateToken']);

Route::get('/send-email', [EmailController::class, 'sendEmail']);


Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
