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
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StocksController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/template', function(){
	return view('layouts.master');
});
// Categories
Route::middleware(['auth:sanctum'])->group(function () {

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
});


