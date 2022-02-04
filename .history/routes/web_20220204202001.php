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
use App\Http\Controllers\MemoController;
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
Route::group(['middleware' => ['auth']], function() {
    // your routes
    Route::get('/', [OrderController::class, 'home']);

// Route::get('/notes/home', [NoteController::class, 'note_home'])->name('note_home');
// Route::get('/notes/home/{id}', [NoteController::class, 'day']);
// Route::get('/notes/home/{id}/{day}', [NoteController::class, 'orders'])->name('home_orders');
    Route::get('/notes/home/{y}/{m}/{d}',[NoteController::class, 'order'])->name('home_order');
    Route::get('/notes/maker/ajax', [NoteController::class, 'maker']);
    Route::get('/notes/gain/ajax', [NoteController::class, 'gain']);
    Route::get('/pdf/{id}/{day}',[PDFController::class, 'note'])->name('pdf');
    Route::post('/memos/{y}/{m}/{d}/store', [MemoController::class, 'store'])->name('memos_store');
    Route::delete('/memos/{y}/{m}/{d}/{id}', [MemoController::class, 'delete'])->name("memos_delete");


    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{maker}/home', [OrderController::class, 'home'])->name('index_home');
    Route::get('/orders/{maker}/{genre}/home', [OrderController::class, 'genre_home']);
    // Route::get('/orders/select', [OrderController::class, 'select'])->name('orders_select');
    Route::get('/orders/{maintenance}/show', [OrderController::class, 'show'])
            ->name('home_show');
    Route::get('/orders/genre/ajax', [OrderController::class, 'genre']);
    Route::get('/orders/search/ajax', [OrderController::class, 'search']);
    Route::post('/orders/purchase/conclude', [OrderController::class, 'conclude']);


    Route::get('/orders/purchase', [OrderController::class, 'purchase'])->name('orders_purchase');
    Route::post('/orders/purchase/store', [OrderController::class, 'store'])->name('orders_store');
    Route::put('/orders/purchase/{purchase}/update', [OrderController::class, 'update'])
        ->name('orders_update')
        ->where('purchase', '[0-9]+');
    Route::delete('/orders/purchase/{purchase}/delete', [OrderController::class, 'delete'])
        ->name('orders_delete')
        ->where('purchase', '[0-9]+');
    Route::get('/purchase/{maker}/specify', [OrderController::class, 'specify']);


    Route::get('/orders/purchase/note', [OrderController::class, 'note_today'])->name('note_today');
    Route::get('/orders/purchase/note_sub', [OrderController::class, 'note_sub'])->name('note_sub');


    // Route::get('/purchase/category/ajax', [OrderController::class, 'category']);


    Route::get('/products', [ProductController::class, 'index'])->name('products');


    Route::resource('/products/makers', MakerController::class);
    Route::resource('/products/categories', CategoryController::class);
    Route::resource('/products/genres', GenreController::class);
    Route::get("/products/genres/category/ajax", [GenreController::class, 'category']);


    Route::get('/products/maintenances', [MaintenanceController::class, 'index'])->name('maintenance.index');
    Route::get('/products/maintenances/create', [MaintenanceController::class, 'create'])->name('maintenance.create');
    Route::post('/products/maintenances/store', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::get('/products/maintenances/{maintenance}/show', [MaintenanceController::class, 'show'])
        ->name('maintenance.show')
        ->where('maintenance', '[0-9]+');
    Route::get('/products/maintenances/csv', [MaintenanceController::class, 'csv']);
    Route::post('/products/maintenances/csv/store', [MaintenanceController::class, 'csv_store'])->name('csv_store');
    Route::get('/products/maintenances/maker/{maker}', [MaintenanceController::class, 'maker_index'])
            ->where('maker', '[0-9]+');
    Route::get('/maintenances/search/ajax', [MaintenanceController::class, 'search']);

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



    // Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/pdf/{maker}',[PDFController::class, 'index'])->name('pdf');
});

Auth::routes();

Route::get('/hello', function () {
        $pdf = PDF::loadHTML('<h1>こんにちは</h1>');

        return $pdf->setOption('encoding', 'utf-8')->inline();

});



