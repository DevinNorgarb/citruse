<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DistributorController;
use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\SupplierController;
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

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout');
    });
});

Route::prefix('distributors')->controller(DistributorController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{distributor}', 'show');
    Route::put('/{distributor}', 'update');
    Route::delete('/{distributor}', 'destroy');
    Route::get('/{distributor}/active-orders', 'activePurchaseOrders');
    Route::get('/{distributor}/completed-orders', 'completedPurchaseOrders');
    Route::patch('/{distributor}/credit-limit', 'updateCreditLimit');
});

// Supplier routes
Route::prefix('suppliers')->controller(SupplierController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{supplier}', 'show');
    Route::put('/{supplier}', 'update');
    Route::delete('/{supplier}', 'destroy');
    Route::get('/{supplier}/active-orders', 'activePurchaseOrders');
    Route::get('/{supplier}/completed-orders', 'completedPurchaseOrders');
});

// Purchase Order routes
Route::prefix('purchase-orders')->controller(PurchaseOrderController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{purchaseOrder}', 'show');
    Route::put('/{purchaseOrder}', 'update');
    Route::delete('/{purchaseOrder}', 'destroy');
    Route::post('/{purchaseOrder}/accept-by-supplier', 'acceptBySupplier');
    Route::post('/{purchaseOrder}/mark-in-delivery', 'markInDelivery');
    Route::post('/{purchaseOrder}/mark-delivered', 'markDelivered');
    Route::post('/{purchaseOrder}/reject-by-supplier', 'rejectBySupplier');
    Route::post('/{purchaseOrder}/reject-by-distributor', 'rejectByDistributor');
    Route::post('/{purchaseOrder}/cancel', 'cancel');
});
