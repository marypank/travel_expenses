<?php

namespace App\Http\Services;

use App\Models\Dto\TripDto;
use App\Models\Trip;
use App\Repositories\TripRepository;

class TripService extends BaseService
{
    /** @var TripRepository $tripRepository */
    private TripRepository $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function create(TripDto $tripDto): void
    {
        // todo: dont like that dates go in strings not like dates
        // todo: custom Exception#
        // todo: I DONT LIKE SET MODEL THING!!!!!!
        if (!$tripDto->getUserId()) {
            // new Exception
        }

        try {
            $trip = $this->tripRepository->setModel(new Trip())->create($tripDto->toArray());

            if (!$trip) {
                throw new \Exception("not created");
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
}