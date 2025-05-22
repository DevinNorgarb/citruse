<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distributors = Distributor::latest()->paginate(10);
        return response()->json($distributors);
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
            'credit_terms' => 'nullable|string',
            'credit_limit' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $distributor = Distributor::create($request->all());
        return response()->json($distributor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Distributor $distributor)
    {
        return response()->json($distributor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Distributor $distributor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distributor $distributor)
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
            'credit_terms' => 'nullable|string',
            'credit_limit' => 'nullable|numeric|min:0',
            'currency' => 'sometimes|required|string|max:3',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $distributor->update($request->all());
        return response()->json($distributor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Distributor $distributor)
    {
        $distributor->delete();
        return response()->json(null, 204);
    }

    public function activePurchaseOrders(Distributor $distributor)
    {
        $orders = $distributor->activePurchaseOrders()->with('items')->get();
        return response()->json($orders);
    }

    public function completedPurchaseOrders(Distributor $distributor)
    {
        $orders = $distributor->completedPurchaseOrders()->with('items')->get();
        return response()->json($orders);
    }

    public function updateCreditLimit(Request $request, Distributor $distributor)
    {
        $validator = Validator::make($request->all(), [
            'credit_limit' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $distributor->update(['credit_limit' => $request->credit_limit]);
        return response()->json($distributor);
    }
}
