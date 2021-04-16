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
use App\Http\Controllers\UserController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ReturnProductsController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/template', function(){
	return view('layouts.master');
});
Route::get('logout', [UserController::class, 'logout'])->name('users.logout');
// Categories
Route::middleware(['auth:sanctum'])->group(function () {

    Route::resource('user', UserController::class);
 

    Route::resource('categories', CategoriesController::class);
    Route::get('/api/categories', [CategoriesController::class, 'getCategoriesJson']);

    Route::resource('brands', BrandsController::class);
    Route::get('/api/brands', [BrandsController::class, 'getBrandsJson']);

    Route::resource('sizes', SizesController::class);
    Route::get('/api/size', [SizesController::class, 'getSizeJson']);

    Route::resource('products', ProductsController::class);
    Route::get('/api/products', [ProductsController::class, 'getProductsJson']);

    Route::get('stocks', [StocksController::class, 'stock'])->name('stock');
    Route::post('stocks', [StocksController::class, 'stockSubmit'])->name('stockSubmit');
    Route::get('stocks/history', [StocksController::class, 'history'])->name('stockHistory');

    Route::get('return_products', [ReturnProductsController::class, 'returnProduct'])->name('returnProduct');
    Route::post('return_product', [ReturnProductsController::class, 'returnProductSubmit'])->name('returnProductSubmit');
    Route::get('return_products/history', [ReturnProductsController::class, 'history'])->name('returnProductHistory');
});


