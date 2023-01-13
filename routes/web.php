<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index')->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->name('index')->middleware('auth');
Route::post('/store', [HomeController::class, 'store'])->name('store')->middleware('auth');
Route::get('/create', [HomeController::class, 'create'])->name('create')->middleware('auth');
Route::post('/show', [HomeController::class, 'show'])->name('show')->middleware('auth');
Route::get('/show', [HomeController::class, 'show'])->name('show')->middleware('auth');
Route::get('/edit/{todo}', [HomeController::class, 'edit'])->name('edit')->middleware('auth');
Route::put('/edit/{todo}', [HomeController::class, 'update'])->name('update')->middleware('auth');
Route::delete('/{todo}', [HomeController::class, 'destroy'])->name('destroy')->middleware('auth');
Route::get('/reference/{todo}', [HomeController::class, 'reference'])->name('reference')->middleware('auth');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('/users', [UsersController::class, 'delete'])->name('users');
Route::delete('/users/delete', [UsersController::class, 'destroy'])->name('users.destroy')->middleware('auth');
