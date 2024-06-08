<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTripsByUserRequest;
use App\Http\Requests\SlugTripRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\TripResource;
use App\Http\Services\TripService;
use App\Models\Dto\SearchTripDto;
use App\Models\Dto\TripDto;
use App\Models\Enum\TripStatusEnum;
use App\Models\Trip;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    /** @var TripService $tripService */
    private TripService $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    public function index()
    {
        //
    }

    public function getTripsByUser(GetTripsByUserRequest $request)
    {
        $dto = new SearchTripDto(...$request->all());
        
        $trips = $this->tripService->getTripsByUser($dto);

        return TripResource::collection($trips);
    }

    public function store(StoreTripRequest $request)
    {
        // todo: make middleware return json or baseController about json return
        // должно получится, что отдаем массив или коллекцию или модель,
        // а middleware в зависимости от того модель это или коллекция оборачивает это в соотвествующий ресурс??
        $dto = new TripDto($request->all());

        try {
            $dto->setStatus(TripStatusEnum::AWAIT->value); // todo: это должно быть в сервисе
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
        // todo: think how i can get dependency injection here and to catch NotFoundHttpException before middleware??

        return new TripResource($trip);
    }

    public function showBySlug(SlugTripRequest $request)
    {
        $trip = $this->tripService->findBySlug($request->slug);

        return new TripResource($trip);
    }

    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $dto = new TripDto($request->all());

        $dto->setId($trip->id);
        $trip = $this->tripService->update($dto);

        return new TripResource($trip);
    }

    public function destroy(Trip $trip)
    {
        $this->tripService->delete($trip->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
