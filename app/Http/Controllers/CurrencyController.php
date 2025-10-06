<?php

namespace App\Http\Controllers;

use App\Http\Services\CurrencyService;

class CurrencyController extends Controller
{
    public function __construct(private readonly CurrencyService $currencyService)
    {}

    /**
     * @OA\Get(
     *     path="/currencies",
     *     description="Get all currencies",
     *     tags={"Currencies"},
     *     security={{"bearer_token":{}}},
     *     summary="Get all currencies",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/CurrencyResource"),
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
            'data' => $this->currencyService->all(),
            'message' => '',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/currencies/{id}",
     *     description="Get single currency by id",
     *     tags={"Currencies"},
     *     security={{"bearer_token":{}}},
     *     summary="Get one single currency by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="currency id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/CurrencyResourceItem")
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
    public function show(int $id)
    {
        return response()->json([
            'data' => $this->currencyService->getById($id),
            'message' => '',
        ]);
    }
}
