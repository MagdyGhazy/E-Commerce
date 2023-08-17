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



Route::get('/admin', function () {
    return view('dashboard.index');
})->name('admin');
Route::put('settings/{settings}/update',[\App\Http\Controllers\Dashboard\SettingsController::class,'update'])->name('settings.update');
Route::get('settings',[\App\Http\Controllers\Dashboard\SettingsController::class,'index'])->name('settings');


