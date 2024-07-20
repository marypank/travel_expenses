<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripExpense\SearchTripExpenseRequest;
use App\Http\Requests\TripExpense\StoreTripExpenseRequest;
use App\Http\Requests\TripExpense\UpdateTripExpenseRequest;
use App\Http\Resources\TripExpenseResource;
use App\Http\Services\TripExpenseService;
use App\Models\Dto\TripExpense\TripExpenseDto;
use App\Models\TripExpense;
use Symfony\Component\HttpFoundation\Response;

class TripExpenseController extends Controller
{
    private TripExpenseService $tripExpenseService;

    public function __construct(TripExpenseService $tripExpenseService)
    {
        $this->tripExpenseService = $tripExpenseService;
    }

    public function index(SearchTripExpenseRequest $request)
    {
        // todo: dto
        // todo: мне кажется, что не надо все выводить подряд. Если это дочерние, то надо вложить, а из общего выпилить
        $result = $this->tripExpenseService->search($request->all());

        // todo: потом сменить метод, а этот отчистить
        return TripExpenseResource::collection($result);
    }

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

    public function show(TripExpense $tripExpense)
    {
        // todo: request, with relation or without
        return new TripExpenseResource($tripExpense);
    }

    public function update(UpdateTripExpenseRequest $request, TripExpense $tripExpense)
    {
        $dto = new TripExpenseDto($request->all());

        $dto->setId($tripExpense->id);
        $trip = $this->tripExpenseService->update($dto);

        return new TripExpenseResource($trip);
    }

    public function destroy(TripExpense $tripExpense)
    {
        $this->tripExpenseService->delete($tripExpense->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
