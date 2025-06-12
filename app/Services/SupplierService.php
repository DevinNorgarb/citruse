<?php

namespace App\Services;

use App\Models\Supplier;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SupplierService
{
    /**
     * Get all suppliers, optionally paginated.
     *
     * @param int|null $perPage
     * @return Collection|LengthAwarePaginator
     */
    public function getAllSuppliers(?int $perPage = null): Collection|LengthAwarePaginator
    {
        return $perPage
            ? Supplier::latest()->paginate($perPage)
            : Supplier::latest()->get();
    }

    /**
     * Create a new supplier.
     *
     * @param array $data
     * @return Supplier
     */
    public function createSupplier(array $data): Supplier
    {
        return Supplier::create($data);
    }

    /**
     * Update an existing supplier.
     *
     * @param Supplier $supplier
     * @param array $data
     * @return Supplier
     */
    public function updateSupplier(Supplier $supplier, array $data): Supplier
    {
        $supplier->update($data);
        return $supplier->fresh();
    }

    /**
     * Delete a supplier.
     *
     * @param Supplier $supplier
     * @return bool
     */
    public function deleteSupplier(Supplier $supplier): bool
    {
        return $supplier->delete();
    }

    /**
     * Get active purchase orders for a supplier.
     *
     * @param Supplier $supplier
     * @return Collection
     */
    public function getActivePurchaseOrders(Supplier $supplier): Collection
    {
        return $supplier->purchaseOrders()
            ->whereIn('status', ['pending', 'accepted', 'in_delivery'])
            ->get();
    }

    /**
     * Get completed purchase orders for a supplier.
     *
     * @param Supplier $supplier
     * @return Collection
     */
    public function getCompletedPurchaseOrders(Supplier $supplier): Collection
    {
        return $supplier->purchaseOrders()
            ->where('status', 'delivered')
            ->get();
    }
}