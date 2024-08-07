<?php

namespace App\Http\Services;

use App\Models\Dto\Trip\SearchTripDto;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TripService extends BaseService
{
    public function __construct(TripRepository $mainRepository)
    {
        parent::__construct($mainRepository);
    }

    /**
     * @param string $slug
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return Trip|null
     */
    public function findBySlug(string $slug): ?Trip
    {
        $trip = $this->mainRepository->findBySlug($slug);

        if (!$trip) { // todo: refactor later
            throw new NotFoundHttpException("RecordNotFound");
        }

        return $trip;
    }

    /**
     * @param SearchTripDto $dto
     * @return Collection
     */
    public function search($dto): Collection
    {
        $dto->setUserId(auth()->user()->id);

        return $this->mainRepository->search($dto->getUserId(), $dto->getStatus(), $dto->getDateFrom(), $dto->getDateTo());
    }

}