<?php

namespace App\Services;

use App\Models\Distributor;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DistributorService
{
    /**
     * Get all distributors, optionally paginated.
     *
     * @param int|null $perPage
     * @return Collection|LengthAwarePaginator
     */
    public function getAllDistributors(?int $perPage = null): Collection|LengthAwarePaginator
    {
        return $perPage
            ? Distributor::latest()->paginate($perPage)
            : Distributor::latest()->get();
    }

    /**
     * Create a new distributor.
     *
     * @param array $data
     * @return Distributor
     */
    public function createDistributor(array $data): Distributor
    {
        return Distributor::create($data);
    }

    /**
     * Update an existing distributor.
     *
     * @param Distributor $distributor
     * @param array $data
     * @return Distributor
     */
    public function updateDistributor(Distributor $distributor, array $data): Distributor
    {
        $distributor->update($data);
        return $distributor->fresh();
    }

    /**
     * Delete a distributor.
     *
     * @param Distributor $distributor
     * @return bool
     */
    public function deleteDistributor(Distributor $distributor): bool
    {
        return $distributor->delete();
    }

    /**
     * Get active purchase orders for a distributor.
     *
     * @param Distributor $distributor
     * @return Collection
     */
    public function getActivePurchaseOrders(Distributor $distributor): Collection
    {
        return $distributor->purchaseOrders()
            ->whereIn('status', ['pending', 'accepted', 'in_delivery'])
            ->get();
    }

    /**
     * Get completed purchase orders for a distributor.
     *
     * @param Distributor $distributor
     * @return Collection
     */
    public function getCompletedPurchaseOrders(Distributor $distributor): Collection
    {
        return $distributor->purchaseOrders()
            ->where('status', 'delivered')
            ->get();
    }

    /**
     * Update distributor's credit limit.
     *
     * @param Distributor $distributor
     * @param float $creditLimit
     * @return Distributor
     */
    public function updateCreditLimit(Distributor $distributor, float $creditLimit): Distributor
    {
        $distributor->update(['credit_limit' => $creditLimit]);
        return $distributor->fresh();
    }
}