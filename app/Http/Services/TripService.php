<?php

namespace App\Http\Services;

use App\Helpers\DateHelper;
use App\Http\Services\Base\BaseService;
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

        if (!$trip) { // todo: custom
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
        return new Collection();
    }

    /**
     * @param Trip $trip
     * @param UpdateTripDto $dto
     * @return Trip
     */
    public function update(Model $trip, BaseDtoInterface $dto): Model
    {
        if ($dto->getDateFrom()) {
            if (DateHelper::isChildDateGreater($dto->getDateFrom(), $trip->date_to)) {
                throw new \Exception('DateFrom must not be great than DateTo'); // todo: custom
            }
            if ($trip->details->where('date_from', '<', $dto->getDateFrom())->count()) {
                throw new \Exception('DateFrom must be less than child dates'); // todo: custom
            }
        }
        if ($dto->getDateTo()) {
            if (DateHelper::isChildDateLess($dto->getDateTo(), $trip->date_from)) {
                throw new \Exception('DateTo must be greater than DateFrom'); // todo: custom
            }

            if ($trip->details->where('date_to', '>', $dto->getDateTo())->count()) {
                throw new \Exception('DateTo must be greater than child dates'); // todo: custom
            }
        }

        return $this->mainRepository->update($trip->id, $dto->toArray());
    }

}