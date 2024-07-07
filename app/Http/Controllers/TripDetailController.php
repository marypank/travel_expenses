<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripDetailRequest;
use App\Http\Requests\UpdateTripDetailRequest;
use App\Http\Resources\TripDetailResource;
use App\Http\Services\TripDetailService;
use App\Models\Dto\TripDetailDto;
use App\Models\Dto\UpdateTripDetailDto;
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

    public function index()
    {
        //
    }

    public function store(StoreTripDetailRequest $request)
    {
        $dto = new TripDetailDto($request->all());

        try {
            // todo: проверка, что выбранная дата начала не мб меньше, чем у трипа и дата конца не мб больше, чем у трипа
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
        // todo: show with details like how much already spend, how much left (money, days, ets)
        return new TripDetailResource($tripDetail);
    }

    public function update(UpdateTripDetailRequest $request, TripDetail $tripDetail)
    {
        $dto = new UpdateTripDetailDto($request->all());

        $dto->setId($tripDetail->id);
        $trip = $this->tripDetailService->update($dto);

        return new TripDetailResource($trip);
    }

    public function destroy(TripDetail $tripDetail)
    {
        $this->tripDetailService->delete($tripDetail->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
