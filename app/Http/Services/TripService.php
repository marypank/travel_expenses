<?php

namespace App\Http\Services;

use App\Http\Services\Base\DateHelper;
use App\Models\Dto\Base\BaseDtoInterface;
use App\Models\Dto\Trip\SearchTripDto;
use App\Models\Dto\Trip\UpdateTripDto;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TripService extends BaseService
{
    public function __construct(TripRepository $mainRepository)
    {
        parent::__construct($mainRepository);
    }

    /**
     * @param string $slug
     * @throws NotFoundHttpException
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

        return new Collection();
        // return $this->mainRepository->search($dto->getUserId(), $dto->getStatus(), $dto->getDateFrom(), $dto->getDateTo());
    }

    /**
     * @param Trip $trip
     * @param UpdateTripDto $dto
     * @return Model
     */
    public function update(Model $trip, BaseDtoInterface $dto): Model
    {
        // todo: compare dates
        if ($dto->getDateFrom() && !DateHelper::checkDateParentMismatch($dto->getDateFrom(), $trip->date_from)) {
            var_dump(123);
        }
        if ($dto->getDateTo() && !DateHelper::checkDateParentMismatch($dto->getDateTo(), $trip->date_to)) {
            var_dump(123);
        }
        exit();

        // return $this->mainRepository->update($trip->id, $dto->toArray());
    }

}