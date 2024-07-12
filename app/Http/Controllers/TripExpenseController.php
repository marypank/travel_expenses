<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripExpenseRequest;
use App\Http\Resources\TripExpenseResource;
use App\Http\Services\TripExpenseService;
use App\Models\Dto\TripExpenseDto;
use App\Models\TripExpense;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripExpenseController extends Controller
{
    private TripExpenseService $tripExpenseService;

    public function __construct(TripExpenseService $tripExpenseService)
    {
        $this->tripExpenseService = $tripExpenseService;
    }

    public function index(Request $request)
    {
        // [] 1. показать все траты по tripId (и внутри траты по parent_id)
        // [+] 2. показать траты внутри трат (по parent_id)
        // [] 3. Обновление
        // [+] 4. Сохранение
        // [+] 5. Удаление родительского вместе с дочерними
        // [+] 6. Удаление дочернего

        // todo: потом сменить метод, а этот отчистить
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

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(TripExpense $tripExpense)
    {
        $this->tripExpenseService->delete($tripExpense->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
