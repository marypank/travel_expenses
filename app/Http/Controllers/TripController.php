<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trip\SearchTripRequest;
use App\Http\Requests\Trip\SlugTripRequest;
use App\Http\Requests\Trip\StoreTripRequest;
use App\Http\Requests\Trip\UpdateTripRequest;
use App\Http\Resources\TripResource;
use App\Http\Services\TripService;
use App\Models\Dto\Trip\SearchTripDto;
use App\Models\Dto\Trip\TripDto;
use App\Models\Dto\Trip\UpdateTripDto;
use App\Models\Trip;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    /** @var TripService $tripService */
    private TripService $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    // todo: make middleware return json or baseController about json return
    // должно получится, что отдаем массив или коллекцию или модель,
    // а middleware в зависимости от того модель это или коллекция оборачивает это в соотвествующий ресурс??

    // todo: remake
    public function index(SearchTripRequest $request)
    {
        $dto = new SearchTripDto(...$request->all());
        
        $trips = $this->tripService->search($dto);

        return TripResource::collection($trips);
    }

    // todo: remake
    public function store(StoreTripRequest $request)
    {
        $dto = new TripDto(...$request->all());

        try {
            $this->tripService->create($dto);
        } catch (\Exception $ex) {
            return response()->json([
                'data' => [],
                'message' => $ex->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->noContent(Response::HTTP_CREATED);
    }

    // todo: remake
    public function show(Trip $trip)
    {
        // todo: think how i can get dependency injection here and to catch NotFoundHttpException before middleware??
        return new TripResource($trip);
    }

    // todo: remake
    public function showBySlug(SlugTripRequest $request)
    {
        $trip = $this->tripService->findBySlug($request->slug);

        return new TripResource($trip);
    }

    // todo: remake
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $dto = new UpdateTripDto($request->all());

        $dto->setId($trip->id);
        $trip = $this->tripService->update($dto);

        return new TripResource($trip);
    }

    // todo: remake
    public function destroy(Trip $trip)
    {
        $this->tripService->delete($trip->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
