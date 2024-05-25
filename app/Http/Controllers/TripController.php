<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Http\Services\TripService;
use App\Models\Dto\TripDto;
use Illuminate\Http\Request;

class TripController extends Controller
{
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
        // пока что ничего не возвращает
        $dto = new TripDto(...$request->all());
        $dto->setUserId(auth()->user()->id);

        $this->tripService->create($dto);
    }

    public function show(string $id)
    {
        // return Language::find($id);
    }

    public function update(Request $request, string $id)
    {
        // return tap(Language::find($id))->update($data)->fresh();
    }

    public function destroy(string $id)
    {
        //
    }
}
