<?php

namespace App\Http\Services;

use App\Helpers\DateHelper;
use App\Models\Dto\BaseDto;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TripService extends BaseService
{
    public function __construct(public TripRepository $tripRepository)
    {
        parent::__construct($tripRepository);
    }

    /**
     * @param string|int $id
     * @return void
     */
    public function getByIdOrSlug(string|int $id)
    {
        if (ctype_digit($id)) {
            $trip = $this->mainRepository->getById($id);
        } else {
            $trip = $this->mainRepository->getBySlug($id);
        }

        if (!$trip) {
            throw new NotFoundHttpException("RecordNotFound");
        }

        return $trip;
    }

    public function update(Model $trip, BaseDto $dto): Model
    {
        if ($dto->getDateFrom() && !$dto->getDateTo()) {
            if (DateHelper::isChildDateGreater($dto->getDateFrom(), $trip->date_to)) {
                throw new \Exception('DateFrom must not be great than DateTo');
            }
        }
        if ($dto->getDateTo() && !$dto->getDateFrom()) {
            if (DateHelper::isChildDateLess($dto->getDateTo(), $trip->date_from)) {
                throw new \Exception('DateTo must be greater than DateFrom');
            }
        }

        return $this->mainRepository->update($trip->id, $dto->toArray());
    }
}