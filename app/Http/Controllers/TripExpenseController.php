<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripExpenseResource;
use App\Http\Services\TripExpenseService;
use App\Models\TripExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TripExpenseController extends Controller
{
    public function __construct(private readonly TripExpenseService $tripExpenseService)
    {}

    public function index(Request $request)
    {
        if (isset($request['tripId'])) {
            $this->authorize('viewAny', [TripExpense::class, $request['tripId']]);

            return TripExpenseResource::collection($this->tripExpenseService->all($request['tripId']));
        }

        return response()->json(['data' => []]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(TripExpense $tripExpense)
    {
        $this->authorize('view', $tripExpense);

        return new TripExpenseResource($tripExpense);
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
