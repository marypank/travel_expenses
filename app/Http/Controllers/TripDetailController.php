<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripDetail\SearchTripDetailRequest;
use App\Http\Requests\TripDetail\StoreTripDetailRequest;
use App\Http\Requests\TripDetail\UpdateTripDetailRequest;
use App\Http\Resources\TripDetailResource;
use App\Http\Services\TripDetailService;
use App\Models\Dto\TripDetail\SearchTripDetailDto;
use App\Models\Dto\TripDetail\TripDetailDto;
use App\Models\Dto\TripDetail\UpdateTripDetailDto;
use App\Models\TripDetail;
use Symfony\Component\HttpFoundation\Response;

class TripDetailController extends Controller
{
    /** @var TripDetailService $tripDetailService */
    private TripDetailService $tripDetailService;

    public function __construct(TripDetailService $tripDetailService)
    {
        $this->tripDetailService = $tripDetailService;
    }

    public function index(SearchTripDetailRequest $request)
    {
        $dto = new SearchTripDetailDto(...$request->all());

        $result = $this->tripDetailService->search($dto);

        return TripDetailResource::collection($result);
    }

    public function store(StoreTripDetailRequest $request)
    {
        $dto = new TripDetailDto($request->all());

        try {
            $this->tripDetailService->create($dto);
        } catch (\Exception $ex) {
            return response()->json([
                'data' => [],
                'message' => $ex->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->noContent(Response::HTTP_CREATED);
    }

    public function show(TripDetail $tripDetail)
    {
        return new TripDetailResource($tripDetail);
    }

    public function update(UpdateTripDetailRequest $request, TripDetail $tripDetail)
    {
        $dto = new UpdateTripDetailDto($request->all());

        $trip = $this->tripDetailService->update($dto, $tripDetail->id, $tripDetail->trip->id);

        return new TripDetailResource($trip);
    }

    public function destroy(TripDetail $tripDetail)
    {
        $this->tripDetailService->delete($tripDetail->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
