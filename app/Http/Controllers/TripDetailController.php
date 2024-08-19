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
use Illuminate\Http\Request;
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
        $result = $this->tripDetailService->all($request['tripId']);

        return TripDetailResource::collection($result);
    }

    public function store(StoreTripDetailRequest $request)
    {
        $dto = TripDetailDto::create($request->all());

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
        $dto = UpdateTripDetailDto::create($tripDetail->id, $request->validated());

        $trip = $this->tripDetailService->update($tripDetail, $dto);

        return new TripDetailResource($trip);
    }

    public function destroy(TripDetail $tripDetail)
    {
        $this->tripDetailService->delete($tripDetail->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
