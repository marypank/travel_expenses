<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripExpense\SearchTripExpenseRequest;
use App\Http\Requests\TripExpense\StoreTripExpenseRequest;
use App\Http\Requests\TripExpense\UpdateTripExpenseRequest;
use App\Http\Resources\TripExpenseResource;
use App\Http\Services\TripExpenseService;
use App\Models\Dto\TripExpense\SearchTripExpenseDto;
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
        $dto = new SearchTripExpenseDto(...$request->all());
        $result = $this->tripExpenseService->search($dto);

        return TripExpenseResource::collection($result);
    }

    // todo: refactor
    public function store(StoreTripExpenseRequest $request)
    {
        // todo: обработка эксепшона, мол, поле не найдено или пустое? и отправка на фронт
        $dto = new TripExpenseDto($request->all());

        try {
            // todo: проверок никаких нифига ет
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
        $dto = new UpdateTripExpenseDto($tripExpense->id, ...$request->all());

        $trip = $this->tripExpenseService->updateExpense($dto, $tripExpense->parent);

        return new TripExpenseResource($trip);
    }

    public function destroy(TripExpense $tripExpense)
    {
        $this->tripExpenseService->delete($tripExpense->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
