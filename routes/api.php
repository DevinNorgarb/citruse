<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DistributorController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\SupplierController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Supplier routes
    Route::apiResource('suppliers', SupplierController::class);
    Route::get('suppliers/{supplier}/active-orders', [SupplierController::class, 'activePurchaseOrders']);
    Route::get('suppliers/{supplier}/completed-orders', [SupplierController::class, 'completedPurchaseOrders']);

    // Distributor routes
    Route::apiResource('distributors', DistributorController::class);
    Route::get('distributors/{distributor}/active-orders', [DistributorController::class, 'activePurchaseOrders']);
    Route::get('distributors/{distributor}/completed-orders', [DistributorController::class, 'completedPurchaseOrders']);
    Route::patch('distributors/{distributor}/credit-limit', [DistributorController::class, 'updateCreditLimit']);

    // Purchase Order routes
    Route::apiResource('purchase-orders', PurchaseOrderController::class);
    Route::post('purchase-orders/{purchaseOrder}/accept-by-supplier', [PurchaseOrderController::class, 'acceptBySupplier']);
    Route::post('purchase-orders/{purchaseOrder}/mark-in-delivery', [PurchaseOrderController::class, 'markInDelivery']);
    Route::post('purchase-orders/{purchaseOrder}/mark-delivered', [PurchaseOrderController::class, 'markDelivered']);
    Route::post('purchase-orders/{purchaseOrder}/reject-by-supplier', [PurchaseOrderController::class, 'rejectBySupplier']);
    Route::post('purchase-orders/{purchaseOrder}/reject-by-distributor', [PurchaseOrderController::class, 'rejectByDistributor']);
    Route::post('purchase-orders/{purchaseOrder}/cancel', [PurchaseOrderController::class, 'cancel']);
});