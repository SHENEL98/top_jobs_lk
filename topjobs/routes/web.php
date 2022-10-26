<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FreeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [Controller::class,'index']);


Route::resource('products', ProductController::class);
Route::resource('customers',CustomerController::class);
Route::resource('order', OrderController::class);
Route::resource('frees',FreeController::class);

Route::post('add_cart', [OrderController::class,'add_cart']);
Route::post('getcart', [OrderController::class,'getcart']);
Route::get('checkout', [OrderController::class,'checkout_index']);
 // remove cart item route
Route::post('remove_cart', [OrderController::class,'remove_cart']);
Route::post('allremove_cart', [OrderController::class,'allremove_cart']);// remove cart all products
Route::post('place_order', [OrderController::class,'place_order']);
Route::get('/invoice', [OrderController::class,'invoice']);   // print report route for backend
