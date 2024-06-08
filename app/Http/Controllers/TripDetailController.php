<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripDetailResource;
use App\Http\Services\TripDetailService;
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

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(TripDetail $tripDetail)
    {
        $this->tripDetailService->delete($tripDetail->id);

        return response()->noContent(Response::HTTP_NO_CONTENT);
    }
}
