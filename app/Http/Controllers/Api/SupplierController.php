<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\JsonResponse;

class SupplierController extends Controller
{
    protected SupplierService $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of suppliers
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $suppliers = $this->supplierService->getAllSuppliers();

        return response()->json([
            'message' => 'Suppliers retrieved successfully',
            'data' => $suppliers
        ]);
    }

    /**
     * Store a newly created supplier
     *
     * @param StoreSupplierRequest $request
     * @return JsonResponse
     */
    public function store(StoreSupplierRequest $request): JsonResponse
    {
        $supplier = $this->supplierService->createSupplier($request->validated());

        return response()->json([
            'message' => 'Supplier created successfully',
            'data' => $supplier
        ], 201);
    }

    /**
     * Display the specified supplier
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function show(Supplier $supplier): JsonResponse
    {
        return response()->json([
            'message' => 'Supplier retrieved successfully',
            'data' => $supplier
        ]);
    }

    /**
     * Update the specified supplier
     *
     * @param UpdateSupplierRequest $request
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier): JsonResponse
    {
        $updatedSupplier = $this->supplierService->updateSupplier($supplier, $request->validated());

        return response()->json([
            'message' => 'Supplier updated successfully',
            'data' => $updatedSupplier
        ]);
    }

    /**
     * Remove the specified supplier
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        $this->supplierService->deleteSupplier($supplier);

        return response()->json([
            'message' => 'Supplier deleted successfully'
        ]);
    }

    /**
     * Get active purchase orders for a supplier
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function activePurchaseOrders(Supplier $supplier): JsonResponse
    {
        $activeOrders = $this->supplierService->getActivePurchaseOrders($supplier);

        return response()->json([
            'message' => 'Active purchase orders retrieved successfully',
            'data' => $activeOrders
        ]);
    }

    /**
     * Get completed purchase orders for a supplier
     *
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function completedPurchaseOrders(Supplier $supplier): JsonResponse
    {
        $completedOrders = $this->supplierService->getCompletedPurchaseOrders($supplier);

        return response()->json([
            'message' => 'Completed purchase orders retrieved successfully',
            'data' => $completedOrders
        ]);
    }
}