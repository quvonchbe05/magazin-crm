<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ---------------------------------------> Categories <--------------------------------------- //

// Categories list
Route::get('categorylist',[CategoryController::class, 'categoryList']);

// Add Category
Route::post('addcategory',[CategoryController::class, 'addCategory']);

// Update Category
Route::put('updatecategory/{id}',[CategoryController::class, 'updateCategory']);

// Delete Category
Route::delete('deletecategory/{id}',[CategoryController::class, 'deleteCategory']);

// ---------------------------------------> Categories <--------------------------------------- //

// Products list
Route::get('productlist',[ProductController::class, 'productList']);

// Add Product
Route::post('addproduct',[ProductController::class, 'addProduct']);

// Update Product
Route::put('updateproduct/{id}',[ProductController::class, 'updateProduct']);

// Delete Product
Route::delete('deleteproduct/{id}',[ProductController::class, 'deleteProduct']);

// Search Product
Route::post('searchproduct',[ProductController::class, 'searchProduct']);

// Filter By Category Products
Route::post('filterproducts',[ProductController::class, 'filterProducts']);