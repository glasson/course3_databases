<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Medicine;
use App\Http\Controllers\Category;
use App\Http\Controllers\Manufacturer;
use App\Http\Controllers\Product;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Client;
use App\Http\Controllers\SellController;
use App\Http\Controllers\Recipe;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Employee;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\Supply;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Pharmacy;
use App\Http\Controllers\Promotion;

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
Route::post('add/recipe', [Recipe::class, 'add']);
Route::post('add/employee', [Employee::class, 'add']);
Route::post('add/supply', [Supply::class, 'add']);
Route::post('add/pharmacy', [Pharmacy::class, 'add']);
Route::post('add/promotion', [Promotion::class, 'add']);

Route::post('change/medicine', [Medicine::class, 'change']);
Route::post('change/product', [Product::class, 'change']);
Route::post('change/order', [OrderController::class, 'change']);
Route::post('change/sell', [SellController::class, 'change']);
Route::post('change/recipe', [Recipe::class, 'change']);
Route::post('change/employee', [Employee::class, 'change']);
Route::post('change/supply', [Supply::class, 'change']);
Route::post('change/pharmacy', [Pharmacy::class, 'change']);
Route::post('change/promotion', [Promotion::class, 'change']);

Route::post('delete/medicine', [Medicine::class, 'delete']);
Route::post('delete/product', [Product::class, 'delete']);
Route::post('delete/order', [OrderController::class, 'delete']);
Route::post('delete/sell', [SellController::class, 'delete']);
Route::post('delete/recipe', [Recipe::class, 'delete']);
Route::post('delete/employee', [Employee::class, 'delete']);
Route::post('delete/supply', [Supply::class, 'delete_supply']);
Route::post('delete/supplied_product', [Supply::class, 'delete_supplied_product']);
Route::post('delete/pharmacy', [Pharmacy::class, 'delete']);
Route::post('delete/promotion', [Promotion::class, 'delete']);

Route::get('get/medicines', [Medicine::class, 'get']);
Route::get('get/categories', [Category::class, 'get']);
Route::get('get/manufacturers', [Manufacturer::class, 'get']);
Route::get('get/products/{id}', [Product::class, 'getByPharmacyId']);
Route::get('get/discount', [Client::class, 'get']);
Route::get('get/doctor', [DoctorController::class, 'get']);
Route::get('get/role', [RoleController::class, 'get']);
Route::get('get/supplier', [SupplierController::class, 'get']);
Route::get('get/location', [LocationController::class, 'get']);
Route::get('get/promotion', [Promotion::class, 'get']);


Route::get('find/medicines', [Medicine::class, 'find']);
Route::get('find/categories', [Category::class, 'find']);
Route::get('find/manufacturers', [Manufacturer::class, 'find']);
Route::get('find/discount', [Client::class, 'find']);
Route::get('find/doctors', [DoctorController::class, 'find']);
Route::get('find/roles', [RoleController::class, 'find']);
Route::get('find/supplier', [SupplierController::class, 'find']);
Route::get('find/location', [LocationController::class, 'find']);
Route::get('find/products', [Product::class, 'find']);
Route::get('find/ordered_products', [OrderController::class, 'find']);
Route::get('find/recipes', [Recipe::class, 'find']);
Route::get('find/employee', [Employee::class, 'find']);
Route::get('find/supply', [Supply::class, 'find']);
Route::get('find/pharmacy', [Pharmacy::class, 'find']);
