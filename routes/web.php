<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PopController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\HomeController;
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
Route::get('/orders/{maker}/home', [OrderController::class, 'home'])->name('index_home');
Route::get('/orders/{maintenance}/show', [OrderController::class, 'show'])
        ->name('home_show')
        ->where('maintenance', '[0-9]+');
Route::post('/orders/purchase/store', [OrderController::class, 'store'])->name('orders_store');
Route::get('/orders/purchase', [OrderController::class, 'purchase'])->name('orders_purchase');
    

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::resource('/products/makers', MakerController::class);
Route::resource('/products/categories', CategoryController::class);
Route::resource('/products/genres', GenreController::class);

Route::get('/products/maintenances', [MaintenanceController::class, 'index'])->name('maintenance.index');
Route::get('/products/maintenances/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
Route::post('/products/maintenances/store', [MaintenanceController::class, 'store'])->name('maintenance.store');
Route::get('/products/maintenances/{maintenance}/show', [MaintenanceController::class, 'show'])
    ->name('maintenance.show')
    ->where('maintenance', '[0-9]+');

Route::get('/products/maintenances/{maintenance}/edit', [MaintenanceController::class, 'edit'])
    ->name('maintenance.edit')
    ->where('maintenance', '[0-9]+');

Route::put('/products/maintenances/{maintenance}/update', [MaintenanceController::class, 'update'])
    ->name('maintenance.update')
    ->where('maintenance', '[0-9]+');
    
Route::delete('/products/maintenances/{maintenance}/delete', [MaintenanceController::class, 'delete'])
    ->name('maintenance.delete')
    ->where('maintenance', '[0-9]+');

Route::get('/products/maintenances/maker/ajax', [MaintenanceController::class, 'maker']);
Route::get('/products/maintenances/category/ajax', [MaintenanceController::class, 'category']);



Route::get('/pops',[PopController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


