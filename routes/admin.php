<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\SettingsController;
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



Route::get('/admin', function () {
    return view('dashboard.index');
})->name('admin');

Route::group(['as' => 'dashboard.'], function () {
    Route::put('settings/{setting}/update',[SettingsController::class , 'update'])->name('settings.update');
    Route::get('settings',[SettingsController::class , 'index'])->name('settings.index');

    #### category ####
    Route::get('categories/ajax',[CategoriesController::class , 'getall'])->name('categories.getall');
    Route::delete('categories/delete',[CategoriesController::class , 'delete'])->name('categories.delete');
    Route::resource('categories', CategoriesController::class)->except('destroy','create' , 'show');
    #### /category ####
    #### product ####
    Route::get('products/ajax',[ProductController::class , 'getall'])->name('products.getall');
    Route::resource('products', ProductController::class)->except('show');
    #### /product ####
});
