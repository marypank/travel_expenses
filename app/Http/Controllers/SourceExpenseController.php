<?php

namespace App\Http\Controllers;

use App\Http\Services\Enum\SourceExpenseEnumService;

class SourceExpenseController extends Controller
{
    public function __construct(private readonly SourceExpenseEnumService $sourceExpenseEnumService)
    {}

    /**
     * @OA\Get(
     *     path="/source-expenses",
     *     description="Get all source expenses",
     *     tags={"Source expenses"},
     *     security={{"bearer_token":{}}},
     *     summary="Get all source expenses",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/SourceExpenseResource"),
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
            'data' => $this->sourceExpenseEnumService->all(true),
            'message' => '',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/source-expenses/{id}",
     *     description="Get single source expense by id",
     *     tags={"Source expenses"},
     *     security={{"bearer_token":{}}},
     *     summary="Get one single source expense by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="source expense id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/SourceExpenseResourceItem")
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
            'data' => $this->sourceExpenseEnumService->getByValue($id, true),
            'message' => '',
        ]);
    }
}
