<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTripDetailRequest;
use App\Http\Resources\TripDetailResource;
use App\Http\Services\TripDetailService;
use App\Models\Dto\TripDetailDto;
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

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(TripDetail $tripDetail)
    {
        return new TripDetailResource($tripDetail);
    }

    public function update(UpdateTripDetailRequest $request, TripDetail $tripDetail)
    {
        $dto = new TripDetailDto($request->all());

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
