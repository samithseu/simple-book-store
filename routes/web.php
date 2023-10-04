<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::redirect('/', '/admin/home');

Route::get('admin/home', [HomeController::class, 'index'])->name('home');

Route::resource('admin/customers', CustomerController::class);
Route::resource('admin/books', BookController::class);
Route::resource('admin/orders', OrderController::class);
Route::resource('admin/order-details', OrderDetailController::class);