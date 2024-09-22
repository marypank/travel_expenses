<?php

namespace App\Http\Controllers\Swagger;

class TripController extends Controller
{
    /**
     * @OA\Get(
     *     path="/trips",
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

    public function destroy()
    {}

    public function tag()
    {}
}
