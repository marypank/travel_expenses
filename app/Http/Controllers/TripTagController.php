<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripTag\SearchTripTagRequest;
use App\Http\Resources\TripTagResource;
use App\Http\Services\TripTagService;

class TripTagController extends Controller
{
    public function __construct(private TripTagService $tripTagService)
    {}

    public function index(SearchTripTagRequest $request)
    {
        $request = $request->validated();
        $tags = $this->tripTagService->all(1, $request['forExpenseOnly'] ?? false, $request['canChoose'] ?? null);

        return TripTagResource::collection($tags);
    }
}
