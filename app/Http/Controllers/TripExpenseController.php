<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripExpense\StoreTripExpenseRequest;
use App\Http\Requests\TripExpense\UpdateTripExpenseRequest;
use App\Http\Resources\TripExpenseResource;
use App\Http\Services\TripExpenseService;
use App\Models\Dto\TripExpense\TripExpenseDto;
use App\Models\Dto\TripExpense\UpdateTripExpenseDto;
use App\Models\TripExpense;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function store(StoreTripExpenseRequest $request)
    {
        $dto = TripExpenseDto::create($request->validated());

        try {
            $this->authorize('create', [TripExpense::class, $dto->getTripId()]);

            $this->tripExpenseService->create($dto);
        } catch (\Exception $ex) {
            return response()->json([
                'data' => [],
                'message' => $ex->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->noContent(Response::HTTP_CREATED);
    }

    public function show(TripExpense $tripExpense)
    {
        $this->authorize('view', $tripExpense);

        return new TripExpenseResource($tripExpense);
    }

    public function update(UpdateTripExpenseRequest $request, TripExpense $tripExpense)
    {
        $dto = UpdateTripExpenseDto::create($tripExpense->id, $request->validated());

        $this->authorize('update', $tripExpense);

        $trip = $this->tripExpenseService->update($tripExpense, $dto);

        return new TripExpenseResource($trip);
    }

    public function destroy(TripExpense $tripExpense)
    {
        $this->authorize('delete', $tripExpense);

        $this->tripExpenseService->delete($tripExpense->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
