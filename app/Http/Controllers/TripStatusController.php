<?php

namespace App\Http\Controllers;

use App\Http\Services\Enum\TripStatusEnumService;

class TripStatusController extends Controller
{
    public function __construct(private readonly TripStatusEnumService $tripStatusEnumService)
    {}

    /**
     * @OA\Get(
     *     path="/trip-statuses",
     *     description="Get all trip statuses",
     *     tags={"TripStatuses"},
     *     security={{"bearer_token":{}}},
     *     summary="Get all trip statuses",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TripStatusResource"),
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
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
    public function index()
    {
        return response()->json([
            'data' => $this->tripStatusEnumService->all(true),
            'message' => '',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/trip-statuses/{id}",
     *     description="Get single trip status by id",
     *     tags={"TripStatuses"},
     *     security={{"bearer_token":{}}},
     *     summary="Get one single trip status by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="trip status id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TripStatusResourceItem")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
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
    public function show(string $id)
    {
        return response()->json([
            'data' => $this->tripStatusEnumService->getByValue($id, true),
            'message' => '',
        ]);
    }
}
