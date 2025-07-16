<?php

namespace App\Http\Controllers;

use App\Http\Services\CurrencyService;

class CurrencyController extends Controller
{
    // todo: посмотреть какая коллекция возвращается через ресурсы и нужно ли здесь переделать на нее
    public function __construct(private readonly CurrencyService $currencyService)
    {}

    /**
     * @OA\Get(
     *     path="/api/currencies",
     *     description="Get all currencies",
     *     tags={"Currencies"},
     *     security={{"bearer_token":{}}},
     *     summary="Get all currencies",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Currency")
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
    public function index()
    {
        return $this->currencyService->all();
    }

    /**
     * @OA\Get(
     *     path="/api/currencies/{id}",
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
     *         @OA\JsonContent(ref="#/components/schemas/Currency")
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
     * 
     * @param int $id
     * @return array
     */
    public function show(int $id)
    {
        return $this->currencyService->getById($id);
    }
}
