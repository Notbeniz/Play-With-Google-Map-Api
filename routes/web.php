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

Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('index');
Route::post('/', [App\Http\Controllers\PointsController::class, 'import'])->name('points.import');
Route::get('/export', [App\Http\Controllers\PointsController::class, 'export'])->name('points.export');
Route::get('/map', [App\Http\Controllers\PagesController::class, 'map'] );
Route::get('/direction', [App\Http\Controllers\PointsController::class, 'getDirection'])->name('getDirection');