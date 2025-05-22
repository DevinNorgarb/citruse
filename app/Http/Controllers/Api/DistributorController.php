<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'List of distributors would be returned here',
            'data' => []
        ]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Distributor would be created here',
            'data' => []
        ], 201);
    }

    public function show(Distributor $distributor)
    {
        return response()->json([
            'message' => 'Distributor details would be returned here',
            'data' => []
        ]);
    }

    public function update(Request $request, Distributor $distributor)
    {
        return response()->json([
            'message' => 'Distributor would be updated here',
            'data' => []
        ]);
    }

    public function destroy(Distributor $distributor)
    {
        return response()->json([
            'message' => 'Distributor would be deleted here'
        ]);
    }
}