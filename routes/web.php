<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderLineItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('suppliers', SupplierController::class);
Route::resource('distributors', DistributorController::class);
Route::resource('products', ProductController::class);
Route::resource('purchase-orders', PurchaseOrderController::class);
Route::resource('purchase-order-line-items', PurchaseOrderLineItemController::class);
