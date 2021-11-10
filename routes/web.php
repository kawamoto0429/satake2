<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PopController;
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

Route::get('/', [TopController::class, 'index']);

Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/orders/{maker}/home', [OrderController::class, 'home']);

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::resource('/products/makers', MakerController::class);
Route::resource('/products/categories', CategoryController::class);
Route::resource('/products/genres', GenreController::class);

Route::get('/pops',[PopController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
