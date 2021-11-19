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
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PDFController;
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

Route::get('/notes/home', [NoteController::class, 'note_home'])->name('note_home');
Route::get('/notes/home/{id}', [NoteController::class, 'day']);
Route::get('/notes/home/{id}/{day}', [NoteController::class, 'orders']);
// Route::get('/notes/home/prev/{id}/{day}', [NoteController::class, 'orders_sub'])->name('orders_sub');

// Route::get('/orders/day', [OrderController::class, 'day'])->name('orders_day');
// Route::post('/orders/day/store', [OrderController::class, 'day_store'])->name('day_store');
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/orders/{maker}/home', [OrderController::class, 'home'])->name('index_home');
Route::get('/orders/{maintenance}/show', [OrderController::class, 'show'])
        ->name('home_show');
        

Route::get('/orders/purchase', [OrderController::class, 'purchase'])->name('orders_purchase');
Route::post('/orders/purchase/store', [OrderController::class, 'store'])->name('orders_store');
Route::put('/orders/purchase/{purchase}/update', [OrderController::class, 'update'])
    ->name('orders_update')
    ->where('purchase', '[0-9]+');
Route::delete('/orders/purchase/{purchase}/delete', [OrderController::class, 'delete'])
    ->name('orders_delete')
    ->where('purchase', '[0-9]+');
    
Route::get('/orders/purchase/note', [OrderController::class, 'note_today'])->name('note_today');
Route::get('/orders/purchase/note_sub', [OrderController::class, 'note_sub'])->name('note_sub');

Route::get('/purchase/category/ajax', [OrderController::class, 'category']);

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

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('pdf',[PDFController::class, 'index']);

