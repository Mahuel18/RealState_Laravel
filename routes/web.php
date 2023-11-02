<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\Props\PropertiesController::class, 'index'])->name('home');
Route::get('/prop-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'single'])->name('single.prop');

//Inserting requests
Route::post('/prop-details/{id}', [App\Http\Controllers\Props\PropertiesController::class, 'insertRequests'])->name('insert.request');
