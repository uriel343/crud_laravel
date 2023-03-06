<?php

use App\Http\Controllers\ProductsController;
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

Route::get('get-all-products', [ProductsController::class, 'index']);
Route::get('get-product/{id}', [ProductsController::class, 'show']);
Route::post('create-product', [ProductsController::class, 'store']);
Route::put('products/{id}/update', [ProductsController::class, 'edit']);
Route::delete('products/{id}/delete', [ProductsController::class, 'destroy']);
