<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlugTripRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Http\Services\TripService;
use App\Models\Dto\TripDto;
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

    public function store(StoreTripRequest $request)
    {
        // todo: make middleware return json or baseController about json return
        $dto = new TripDto(...$request->all());
        $dto->setUserId(auth()->user()->id);

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

    public function update(Request $request, Trip $trip)
    {
        // return tap(Trip::find($id))->update($data)->fresh();
    }

    public function destroy(Trip $trip)
    {
        //
    }
}
