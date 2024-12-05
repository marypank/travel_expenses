<?php

namespace App\Http\Controllers\Swagger;

class TripController extends Controller
{
    /**
     * @OA\Get(
     *     path="/trips",
     *     description="Get all user trips",
     *     tags={"Trips"},
     *     summary="Get all user trips",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function index()
    {}

    /**
     * @OA\Post(
     *     path="/trips",
     *     tags={"Trips"},
     *     summary="Save user trip",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function store()
    {}

    /**
     * @OA\Get(
     *     path="/trips/{id}",
     *     tags={"Trips"},
     *     summary="Get user trip by id",
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function show()
    {}

    public function showBySlug()
    {}

    public function update()
    {}

    // todo: исправить проблему, что вместо json присылается html. проблема не в swagger, а, возможно, где-то в настройках
    /**
     * @OA\Delete(
     *     path="/trips/{id}",
     *     tags={"Trips"},
     *     summary="Delete user trip",
     *     description="Delete user trip by id",
     *     operationId="deleteTrip",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Trip id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
     *         @OA\JsonContent(),
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Trip not found",
     *     )
     * )
     */
    public function destroy()
    {}

    public function tag()
    {}
}
