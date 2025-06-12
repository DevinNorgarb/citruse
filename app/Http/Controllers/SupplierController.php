<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class SupplierController extends Controller
{
    /**
     * Display a listing of the suppliers.
     */
    public function index(Request $request)
    {
        // Include the user in the response to verify authentication is working
        return Inertia::render('Suppliers/Index', [
            'auth_check' => [
                'user' => $request->user(),
                'is_authenticated' => auth()->check(),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'vat_number' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'sales_contact_name' => 'required|string|max:255',
            'sales_contact_email' => 'required|email|max:255',
            'sales_contact_phone' => 'required|string|max:255',
            'logistics_contact_name' => 'nullable|string|max:255',
            'logistics_contact_email' => 'nullable|email|max:255',
            'logistics_contact_phone' => 'nullable|string|max:255',
            'payment_terms' => 'nullable|string',
            'currency' => 'required|string|max:3',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $supplier = Supplier::create($request->all());
        return response()->json($supplier, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|required|string|max:255',
            'vat_number' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'sales_contact_name' => 'sometimes|required|string|max:255',
            'sales_contact_email' => 'sometimes|required|email|max:255',
            'sales_contact_phone' => 'sometimes|required|string|max:255',
            'logistics_contact_name' => 'nullable|string|max:255',
            'logistics_contact_email' => 'nullable|email|max:255',
            'logistics_contact_phone' => 'nullable|string|max:255',
            'payment_terms' => 'nullable|string',
            'currency' => 'sometimes|required|string|max:3',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $supplier->update($request->all());
        return response()->json($supplier);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json(null, 204);
    }

    public function activePurchaseOrders(Supplier $supplier)
    {
        $orders = $supplier->activePurchaseOrders()->with('items')->get();
        return response()->json($orders);
    }

    public function completedPurchaseOrders(Supplier $supplier)
    {
        $orders = $supplier->completedPurchaseOrders()->with('items')->get();
        return response()->json($orders);
    }
}
