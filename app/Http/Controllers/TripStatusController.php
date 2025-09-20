<?php

namespace App\Http\Controllers;

use App\Http\Services\Enum\TripStatusEnumService;
use Illuminate\Http\Request;

class TripStatusController extends Controller
{
    public function __construct(private readonly TripStatusEnumService $tripStatusEnumService)
    {}

    public function index()
    {
        return response()->json([
            'data' => $this->tripStatusEnumService->all(true),
            'message' => '',
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        return response()->json([
            'data' => $this->tripStatusEnumService->getByValue($id, true),
            'message' => '',
        ]);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
