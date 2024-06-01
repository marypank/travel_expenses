<?php

namespace App\Http\Services;

use App\Models\Dto\TripDto;
use App\Repositories\TripRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        if (!$tripDto->getUserId()) {
            // new Exception
        }

        try {
            $trip = $this->tripRepository->create($tripDto->toArray());

            if (!$trip) {
                throw new \Exception("not created");
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function findById(int $id)
    {
        // todo: а что насчет ебFнjй политики, которая не должна позволять найти не свой пост
        $trip = $this->tripRepository->findById($id);

        if (!$trip) { // todo: refactor later
            throw new NotFoundHttpException("RecordNotFound");
        }

        return $trip;
    }

    public function findBySlug(string $slug)
    {
        $trip = $this->tripRepository->findBySlug($slug);

        if (!$trip) { // todo: refactor later
            throw new NotFoundHttpException("RecordNotFound");
        }

        return $trip;
    }
}