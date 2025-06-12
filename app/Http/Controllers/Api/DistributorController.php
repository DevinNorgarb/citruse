<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDistributorRequest;
use App\Http\Requests\UpdateDistributorRequest;
use App\Models\Distributor;
use App\Services\DistributorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    protected DistributorService $distributorService;

    public function __construct(DistributorService $distributorService)
    {
        $this->distributorService = $distributorService;
    }

    /**
     * Display a listing of distributors
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $distributors = $this->distributorService->getAllDistributors();

        return response()->json([
            'message' => 'Distributors retrieved successfully',
            'data' => $distributors
        ]);
    }

    /**
     * Store a newly created distributor
     *
     * @param StoreDistributorRequest $request
     * @return JsonResponse
     */
    public function store(StoreDistributorRequest $request): JsonResponse
    {
        $distributor = $this->distributorService->createDistributor($request->validated());

        return response()->json([
            'message' => 'Distributor created successfully',
            'data' => $distributor
        ], 201);
    }

    /**
     * Display the specified distributor
     *
     * @param Distributor $distributor
     * @return JsonResponse
     */
    public function show(Distributor $distributor): JsonResponse
    {
        return response()->json([
            'message' => 'Distributor retrieved successfully',
            'data' => $distributor
        ]);
    }

    /**
     * Update the specified distributor
     *
     * @param UpdateDistributorRequest $request
     * @param Distributor $distributor
     * @return JsonResponse
     */
    public function update(UpdateDistributorRequest $request, Distributor $distributor): JsonResponse
    {
        $updatedDistributor = $this->distributorService->updateDistributor(
            $distributor,
            $request->validated()
        );

        return response()->json([
            'message' => 'Distributor updated successfully',
            'data' => $updatedDistributor
        ]);
    }

    /**
     * Remove the specified distributor
     *
     * @param Distributor $distributor
     * @return JsonResponse
     */
    public function destroy(Distributor $distributor): JsonResponse
    {
        $this->distributorService->deleteDistributor($distributor);

        return response()->json([
            'message' => 'Distributor deleted successfully'
        ]);
    }

    /**
     * Get active purchase orders for a distributor
     *
     * @param Distributor $distributor
     * @return JsonResponse
     */
    public function activePurchaseOrders(Distributor $distributor): JsonResponse
    {
        $activeOrders = $this->distributorService->getActivePurchaseOrders($distributor);

        return response()->json([
            'message' => 'Active purchase orders retrieved successfully',
            'data' => $activeOrders
        ]);
    }

    /**
     * Get completed purchase orders for a distributor
     *
     * @param Distributor $distributor
     * @return JsonResponse
     */
    public function completedPurchaseOrders(Distributor $distributor): JsonResponse
    {
        $completedOrders = $this->distributorService->getCompletedPurchaseOrders($distributor);

        return response()->json([
            'message' => 'Completed purchase orders retrieved successfully',
            'data' => $completedOrders
        ]);
    }

    /**
     * Update distributor's credit limit
     *
     * @param Request $request
     * @param Distributor $distributor
     * @return JsonResponse
     */
    public function updateCreditLimit(Request $request, Distributor $distributor): JsonResponse
    {
        $request->validate([
            'credit_limit' => 'required|numeric|min:0',
        ]);

        $updatedDistributor = $this->distributorService->updateCreditLimit(
            $distributor,
            (float)$request->credit_limit
        );

        return response()->json([
            'message' => 'Credit limit updated successfully',
            'data' => $updatedDistributor
        ]);
    }
}