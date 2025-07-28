<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripExpense\StoreTripExpenseRequest;
use App\Http\Requests\TripExpense\UpdateTripExpenseRequest;
use App\Http\Resources\TripExpenseResource;
use App\Http\Services\TripExpenseService;
use App\Models\Dto\TripExpenseDto;
use App\Models\Dto\UpdateTripExpenseDto;
use App\Models\TripExpense;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripExpenseController extends Controller
{
    public function __construct(private readonly TripExpenseService $tripExpenseService)
    {}

    /**
     * @OA\Get(
     *     path="/trip-expenses",
     *     tags={"TripExpenses"},
     *     security={{"bearer_token":{}}},
     *     summary="Get all trip expenses by tripId",
     *     @OA\Parameter(
     *         name="tripId",
     *         in="path",
     *         description="TripId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TripExpenseResource")
     *         ),
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated.",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error"
     *      )
     *    )
     * )
     */
    public function index(Request $request)
    {
        if (isset($request['tripId'])) {
            return TripExpenseResource::collection($this->tripExpenseService->all($request['tripId']));
        }

        return response()->json([]);
    }

    /**
     * // todo: исключить из RequestBody параметры id и мб другие
     * @OA\Post(
     *     path="/trip-expenses",
     *     description="Create trip expense",
     *     tags={"TripExpenses"},
     *     security={{"bearer_token":{}}},
     *     summary="Create trip expense",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="TripExpense not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/TripExpense")
     *         )
     *     )
     * )
     */
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

    /**
     * // todo: переделать ответ с массива на один объект (swagger)
     * @OA\Get(
     *     path="/trip-expenses/{id}",
     *     description="Get one trip expense by id",
     *     tags={"TripExpenses"},
     *     security={{"bearer_token":{}}},
     *     summary="Get one trip expense by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="trip expense id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TripExpenseResource"),
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated.",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error"
     *      )
     *    )
     * )
     */
    public function show(TripExpense $tripExpense)
    {
        return new TripExpenseResource($tripExpense);
    }

    /**
     * // todo: исключить из RequestBody id
     * // todo: переделать ответ с массива на один объект (swagger)
     * @OA\Patch(
     *     path="/trip-expenses/{id}",
     *     description="Update trip expense by id",
     *     tags={"TripExpenses"},
     *     security={{"bearer_token":{}}},
     *     summary="Update trip expense by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Trip expense id to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Trip expense not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/TripExpense")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TripExpenseResource"),
     *     ),
     * )
     */
    public function update(UpdateTripExpenseRequest $request, TripExpense $tripExpense)
    {
        $dto = UpdateTripExpenseDto::create($tripExpense->id, $request->validated());

        $trip = $this->tripExpenseService->update($tripExpense, $dto);

        return new TripExpenseResource($trip);
    }

    /**
     * @OA\Delete(
     *     path="/trip-expenses/{id}",
     *     tags={"TripExpenses"},
     *     security={{"bearer_token":{}}},
     *     summary="Deletes a trip expense",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Trip expense id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Trip expense not found",
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Deleted",
     *     ),
     * )
     */
    public function destroy(TripExpense $tripExpense)
    {
        $this->tripExpenseService->delete($tripExpense->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
