<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/',function(){
    return redirect()->route('login_form');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login_form');
    Route::post('/login', 'login')->name('login');
});

Route::middleware('auth')->group(function () {

    Route::controller(StatisticController::class)->group(function () {
        Route::get('statistic', 'index')->name('statistic.index');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('register', 'index')->name('register.index');
        Route::post('register', 'register')->name('register.register');
        Route::put('register/update/{id}', 'update')->name('register.update');
        Route::get('register/show/{id}', 'show')->name('register.show');
        Route::get('register/delete/{id}', 'delete')->name('register.delete');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'index')->name('products.index');
        Route::post('products', 'addProduct')->name('products.create');
        Route::get('products/form/{id}', 'updateForm')->name('products.form');
        Route::put('products/update/{id}', 'updateProduct')->name('products.update');
        Route::get('products/show/{id}', 'show')->name('products.show');
        Route::get('products/delete/{id}', 'delete')->name('products.delete');
        Route::get('products/deletePage/{id}', 'deletePage')->name('products.deletePage');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('categories','index')->name('categories.index');
        Route::post('categories','addCategory')->name('categories.add');
        Route::put('categories/update/{id}','updateCategory')->name('categories.update');
        Route::get('categories/delete/{id}','deleteCategory')->name('categories.delete');
    });

    Route::controller(BasketController::class)->group(function(){
        Route::get('sale','index')->name('basket.index');
        Route::post('sale/setToBasket/{id}','setToBasket')->name('basket.toBasket');
        Route::get('sale/basket','basket')->name('basket.basket');
        Route::post('sale/basketRefresh/{id}','basketRefresh')->name('basket.basketRefresh');
        Route::get('sale/saveToSaled','saveToSaled')->name('basket.saveToSaled');
        Route::get('sale/removeBasket','removeBasket')->name('basket.removeBasket');
        Route::get('sale/sale/{id}','sale')->name('basket.sale');
        Route::post('sale/saleOne/{id}','saleOne')->name('basket.saleOne');
    });

});
