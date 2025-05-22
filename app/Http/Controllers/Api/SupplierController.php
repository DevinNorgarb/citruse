<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'List of suppliers would be returned here',
            'data' => []
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Supplier would be created here',
            'data' => []
        ], 201);
    }

    public function show(Supplier $supplier)
    {
        return response()->json([
            'message' => 'Supplier details would be returned here',
            'data' => []
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        return response()->json([
            'message' => 'Supplier would be updated here',
            'data' => []
        ]);
    }

    public function destroy(Supplier $supplier)
    {
        return response()->json([
            'message' => 'Supplier would be deleted here'
        ]);
    }
}