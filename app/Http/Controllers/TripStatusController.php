<?php

namespace App\Http\Controllers;

use App\Http\Services\Enum\TripStatusEnumService;

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

    public function show(string $id)
    {
        return response()->json([
            'data' => $this->tripStatusEnumService->getByValue($id, true),
            'message' => '',
        ]);
    }
}
