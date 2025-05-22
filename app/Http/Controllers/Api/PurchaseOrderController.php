<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'List of purchase orders would be returned here',
            'data' => []
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Purchase order would be created here',
            'data' => []
        ], 201);
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order details would be returned here',
            'data' => []
        ]);
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order would be updated here',
            'data' => []
        ]);
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order would be deleted here'
        ]);
    }

    public function acceptBySupplier(PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order would be accepted by supplier here',
            'data' => []
        ]);
    }

    public function markInDelivery(PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order would be marked as in delivery here',
            'data' => []
        ]);
    }

    public function markDelivered(PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order would be marked as delivered here',
            'data' => []
        ]);
    }

    public function rejectBySupplier(PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order would be rejected by supplier here',
            'data' => []
        ]);
    }

    public function rejectByDistributor(PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order would be rejected by distributor here',
            'data' => []
        ]);
    }

    public function cancel(PurchaseOrder $purchaseOrder)
    {
        return response()->json([
            'message' => 'Purchase order would be cancelled here',
            'data' => []
        ]);
    }
}