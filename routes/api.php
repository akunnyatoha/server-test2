<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//Product
Route::get('/master-products', [ProductController::class, 'index'])->middleware(('auth:sanctum'));
Route::post('/master-products', [ProductController::class, 'store'])->middleware('auth:sanctum');
Route::get('/master-products/{id}', [ProductController::class, 'getProductById'])->middleware('auth:sanctum');
Route::post('/master-products/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');
Route::get('/master-products/destroy/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');

//Customer
Route::get('/master-customers', [CustomerController::class, 'index'])->middleware('auth:sanctum');
Route::post('/master-customers/create', [CustomerController::class, 'store'])->middleware('auth:sanctum');
Route::get('/master-customers/{id}', [CustomerController::class, 'getCustomerById'])->middleware('auth:sanctum');
Route::post('/master-customers/{id}', [CustomerController::class, 'update'])->middleware('auth:sanctum');
Route::get('/master-customers/destroy/{id}', [CustomerController::class, 'destroy'])->middleware('auth:sanctum');

//Sales Order
Route::get('/master-sales-orders', [SalesOrderController::class, 'index'])->middleware('auth:sanctum');
Route::post('/master-sales-orders', [SalesOrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('/master-sales-orders/destroy/{id}', [SalesOrderController::class, 'destroy'])->middleware('auth:sanctum');
