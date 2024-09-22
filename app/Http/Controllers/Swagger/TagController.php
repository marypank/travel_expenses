<?php

namespace App\Http\Controllers\Swagger;

class TagController extends Controller
{
    /**
     * @OA\Get(
     *     path="/tags",
     *     tags={"Tags"},
     *     summary="Get all tags",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function index()
    {}
}
