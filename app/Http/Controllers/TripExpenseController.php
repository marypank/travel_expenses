<?php

namespace App\Http\Controllers;

use App\Http\Actions\TripExpense\TripExpenseTagAction;
use App\Http\Requests\TripExpense\SearchTripExpenseRequest;
use App\Http\Requests\TripExpense\StoreTripExpenseRequest;
use App\Http\Requests\TripExpense\TripExpenseTagRequest;
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
    public function __construct(private TripExpenseService $tripExpenseService)
    {}

    public function index(SearchTripExpenseRequest $request)
    {
        $result = $this->tripExpenseService->search($request->validated());

        return TripExpenseResource::collection($result);
    }

    public function store(StoreTripExpenseRequest $request)
    {
        $dto = TripExpenseDto::create($request->validated());

        try {
            $this->tripExpenseService->create($dto);
        } catch (\Exception $ex) {
            return response()->json([
                'data' => [],
                'message' => $ex->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->noContent(Response::HTTP_CREATED);
    }

    public function show(TripExpense $tripExpense, Request $request)
    {
        $this->tripExpenseService->modfifyForShow($tripExpense, (bool)$request->input('withChildren'));

        return new TripExpenseResource($tripExpense);
    }

    public function update(UpdateTripExpenseRequest $request, TripExpense $tripExpense)
    {
        $dto = UpdateTripExpenseDto::create($tripExpense->id, $request->validated());

        $trip = $this->tripExpenseService->update($tripExpense, $dto);

        return new TripExpenseResource($trip);
    }

    public function destroy(TripExpense $tripExpense)
    {
        $this->tripExpenseService->delete($tripExpense->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }

    public function tag(TripExpenseTagRequest $request)
    {
        $request = $request->validated();
        $action = new TripExpenseTagAction();
        $action->handle($request['id'], $request['tagId'], $request['operation']);

        return response()->noContent(Response::HTTP_CREATED);
    }
}
