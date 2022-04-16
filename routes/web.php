<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
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

Route::controller(ProductController::class)->group(function(){
    Route::get('/', 'index');
    
    Route::prefix('/products')->group(function(){

        Route::get('/create', 'create');
        Route::post('/store', 'store');
        Route::get('/show/{id}', 'show');
        Route::get('/edit/{id}', 'edit');
        Route::put('/update/{id}', 'update');
        Route::delete('/delete/{id}', 'destroy');
    });
});

Route::controller(CategoryController::class)->prefix('/categories')->group(function(){
    Route::get('/', 'index');
    Route::post('/store', 'store');
});
