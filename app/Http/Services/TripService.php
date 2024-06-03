<?php

namespace App\Http\Services;

use App\Models\Trip;
use App\Repositories\TripRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TripService extends BaseService
{
    public function __construct(TripRepository $tripRepository)
    {
        parent::__construct($tripRepository);
    }

    public function findBySlug(string $slug): ?Trip
    {
        $trip = $this->mainRepository->findBySlug($slug);

        if (!$trip) { // todo: refactor later
            throw new NotFoundHttpException("RecordNotFound");
        }

        return $trip;
    }

}