<?php

namespace App\Http\Services;

use App\Models\Dto\Trip\SearchTripDto;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Database\Eloquent\Collection;
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

    public function search(SearchTripDto $dto): Collection
    {
        $dto->setUserId(auth()->user()->id);

        return $this->mainRepository->search($dto->getUserId(), $dto->getStatus(), $dto->getDateFrom(), $dto->getDateTo());
    }

}