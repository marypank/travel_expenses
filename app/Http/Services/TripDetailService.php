<?php

namespace App\Http\Services;

use App\Helpers\DateHelper;
use App\Models\Dto\TripDetail\SearchTripDetailDto;
use App\Models\Enum\TripStatusEnum;
use App\Repositories\TripDetailRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Dto\Base\BaseDtoInterface;
use App\Models\Dto\TripDetail\TripDetailDto;
use App\Models\Dto\TripDetail\UpdateTripDetailDto;
use App\Models\TripDetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TripDetailService extends BaseService
{
    public function __construct(TripDetailRepository $tripDetailRepository)
    {
        parent::__construct($tripDetailRepository);
    }
    
    /**
     * @param TripDetailDto $dto
     * @throws \Exception
     * @return Model
     */
    public function create(BaseDtoInterface $dto): Model
    {
        if ($this->isDatesMismatch($dto->getDateFrom(), $dto->getDateTo(), $dto->getTripId())) {
            throw new \Exception("Parent and child dates doesnt match"); // todo: custom
        }
        // todo: Статусы синхронизировать с родительским трипом, но потом

        try {
            $model = $this->mainRepository->create($dto->toArray());

            if (!$model) {
                throw new \Exception("not created");
            }

            return $model;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function search($dto): Collection
    {
        /* if (!$dto->getTripId()) {
            throw new \Exception('tripId required'); // todo: custom
        }
        if ($dto->getStatus()) {
            $this->checkStatusOrThrowError($dto->getStatus());
        }

        $result = $this->mainRepository->search(
            $dto->getTripId(),
            $dto->getDateFrom(),
            $dto->getDateTo(),
            $dto->getStatus(),
            $dto->getCountryId(),
            $dto->getStatus()
        );

        return $result; */
        return new Collection();
    }

    /**
     * @param TripDetail $tripDetail
     * @param UpdateTripDetailDto $dto
     * @return TripDetail
     */
    public function update(Model $tripDetail, BaseDtoInterface $dto): Model
    // public function update(BaseDtoInterface $dto, int $id = null, int $tripId = null): Model
    {
        /* if (!$id) {
            throw new \Exception('id required'); // todo: custom
        }
        $dto->setId($id);

        if ($dto->getStatus()) {
            $this->checkStatusOrThrowError($dto->getStatus());
        }
        $this->checkDatesOfParentTripOrThrowError($dto->getDateFrom(), $dto->getDateTo(), $tripId);

        return $this->mainRepository->update($dto->getId(), $dto->toArray()); */
        return $this->mainRepository->update($tripDetail->id, $dto->toArray());
    }

    private function isDatesMismatch(Carbon $dateFrom, Carbon $dateTo, int $tripId)
    {
        // todo: поверить, что даты с другими trip details не пересекаются, у которых родитель 1
        $trip = $this->mainRepository->getParentTrip($tripId);

        $dateFromCheck = DateHelper::isChildDateLess($dateFrom, $trip->date_from) || DateHelper::isChildDateGreater($dateFrom, $trip->date_to);
        $dateToCheck = DateHelper::isChildDateLess($dateTo, $trip->date_from) || DateHelper::isChildDateGreater($dateTo, $trip->date_to);

        return $dateToCheck || $dateFromCheck;
    }

}