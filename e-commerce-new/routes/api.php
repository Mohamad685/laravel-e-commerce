<?php

use App\Http\Controllers\LaravelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\OrdersController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/insert_product', [ProductsController::class, 'insert_product']);
Route::post('/update_product', [ProductsController::class, 'update_product']);
Route::post('/get_product', [ProductsController::class, 'get_products']);
Route::post('/update_product', [ProductsController::class, 'delete_product']);
Route::post('/create_user', [UsersController::class, 'create_user']);
Route::post('/create_order', [OrdersController::class, 'create_order']);
Route::post('/add_quantity', [OrderItemsController::class, 'add_quantity']);
Route::post('/get_transactions', [TransactionsController::class, 'get_transactions']);