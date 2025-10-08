<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Http\Resources\TripResource;
use App\Http\Services\TripService;
use App\Models\Dto\Trip\TripDto;
use App\Models\Dto\Trip\UpdateTripDto;
use App\Models\Trip;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    public function __construct(private readonly TripService $tripService)
    {
        $this->authorizeResource(Trip::class);
    }

    /**
     * @OA\Get(
     *     path="/trips",
     *     description="Get all user trips",
     *     tags={"Trips"},
     *     security={{"bearer_token":{}}},
     *     summary="Get all trips",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TripResource")
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
        return TripResource::collection($this->tripService->all());
    }

    /**
     * @OA\Post(
     *     path="/trips",
     *     description="Create trip",
     *     tags={"Trips"},
     *     security={{"bearer_token":{}}},
     *     summary="Create trip",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Trip not found"
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
     *         mediaType="application/json",
     *         @OA\Schema(allOf={
     *              @OA\Schema(ref="#/components/schemas/Trip"),
     *              @OA\Schema(
     *                  properties={
     *                      @OA\Property(property="id", readOnly=true),
     *                      @OA\Property(property="slug", readOnly=true)
     *                  }
     *              )
     *         })
     *         )
     *     )
     * )
     */
    public function store(StoreTripRequest $request)
    {
        $dto = TripDto::create(...$request->validated());

        try {
            $dto->setUserId(auth()->user()->id);
            $this->tripService->create($dto);
        } catch (\Exception $ex) {
            return response()->json([
                'data' => [],
                'message' => $ex->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->noContent(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/trips/{id}",
     *     description="Get single trip by id",
     *     tags={"Trips"},
     *     security={{"bearer_token":{}}},
     *     summary="Get one single trip by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="trip id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TripResourceItem"),
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
    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    /**
     * @OA\Patch(
     *     path="/trips/{id}",
     *     description="Update trip by id",
     *     tags={"Trips"},
     *     security={{"bearer_token":{}}},
     *     summary="Update trip by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Trip id to update",
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
     *         description="Trip not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *         mediaType="application/json",
     *         @OA\Schema(allOf={
     *              @OA\Schema(ref="#/components/schemas/Trip"),
     *              @OA\Schema(
     *                  properties={
     *                      @OA\Property(property="id", readOnly=true)
     *                  }
     *              )
     *         })
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/TripResourceItem"),
     *     ),
     * )
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $dto = UpdateTripDto::create($trip->id, ...$request->validated());

        $trip = $this->tripService->update($trip, $dto);

        return new TripResource($trip);
    }

    /**
     * @OA\Delete(
     *     path="/trips/{id}",
     *     tags={"Trips"},
     *     security={{"bearer_token":{}}},
     *     summary="Deletes a trip",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Trip id to delete",
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
     *         description="Trip not found",
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Deleted",
     *     ),
     * )
     */
    public function destroy(Trip $trip)
    {
        $this->tripService->delete($trip->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
