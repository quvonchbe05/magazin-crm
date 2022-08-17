<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StatisticController;
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
    return redirect()->route('statistic.index');
});


Route::controller(StatisticController::class)->group(function(){
    Route::get('statistic','index')->name('statistic.index');
});

Route::controller(RegisterController::class)->group(function(){
    Route::get('register','index')->name('register.index');
    Route::post('register','register')->name('register.register');
});