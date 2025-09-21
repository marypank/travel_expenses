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

    public function index()
    {
        return TripResource::collection($this->tripService->all());
    }

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

    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $dto = UpdateTripDto::create($trip->id, ...$request->validated());

        $trip = $this->tripService->update($trip, $dto);

        return new TripResource($trip);
    }

    public function destroy(Trip $trip)
    {
        $this->tripService->delete($trip->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
