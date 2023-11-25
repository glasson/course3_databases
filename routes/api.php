<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Medicine;
use App\Http\Controllers\Category;
use App\Http\Controllers\Manufacturer;
use App\Http\Controllers\Product;
use App\Http\Controllers\OrderController;

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

Route::post('add/medicine', [Medicine::class, 'add']);
Route::post('add/product', [Product::class, 'add']);
Route::post('add/order', [OrderController::class, 'add']);
Route::post('add/sell', [SellController::class, 'add']);

Route::get('get/medicines', [Medicine::class, 'get']);
Route::get('get/categories', [Category::class, 'get']);
Route::get('get/manufacturers', [Manufacturer::class, 'get']);
Route::get('get/products/{id}', [Product::class, 'getByPharmacyId']);