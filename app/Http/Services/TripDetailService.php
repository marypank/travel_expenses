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
        if ($this->isDatesOutOfParentRange($dto->getDateFrom(), $dto->getDateTo(), $dto->getTripId())) {
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
        return new Collection();
    }

    /**
     * @param TripDetail $trip
     * @param UpdateTripDetailDto $dto
     * @return TripDetail
     */
    public function update(Model $tripDetail, BaseDtoInterface $dto): Model
    {
        // todo: dates check
        // 1. Дата начала не должна быть меньше, чем дата начала родителя
        // 2. Дата конца не должна быть больше даты конца родителя
        // 3. Дата начала не должна быть больше, чем старая дата конца, если нет новой даты конца
        // 4. Дата конца не должна быть меньше, чем старая дата начала, если нет новой даты начала
        // не закончила 3 и 4, надо проверить 1 и 2
        if ($dto->getDateFrom()) {
            if (DateHelper::isChildDateLess($dto->getDateFrom(), $tripDetail->trip->date_from)) {
                throw new \Exception('DateFrom must not be less than paretn DateFrom'); // todo: custom
            }

            if (!$dto->getDateTo() && DateHelper::isChildDateGreater($dto->getDateFrom(), $tripDetail->date_to)) {
                //
            }
        }
        if ($dto->getDateTo()) {
            if (DateHelper::isChildDateGreater($dto->getDateTo(), $tripDetail->trip->date_to)) {
                throw new \Exception('DateTo must not be greater than parent DateTo'); // todo: custom
            }

            if (!$dto->getDateFrom()) {
                //
            }
        }

        return $this->mainRepository->update($tripDetail->id, $dto->toArray());
    }

    private function isDatesOutOfParentRange(Carbon $dateFrom, Carbon $dateTo, int $tripId): bool
    {
        $trip = $this->mainRepository->getParentTrip($tripId);

        $dateFromCheck = DateHelper::isChildDateLess($dateFrom, $trip->date_from) || DateHelper::isChildDateGreater($dateFrom, $trip->date_to);
        $dateToCheck = DateHelper::isChildDateLess($dateTo, $trip->date_from) || DateHelper::isChildDateGreater($dateTo, $trip->date_to);

        return $dateToCheck || $dateFromCheck;
    }

    private function isDatesSyncingWithSiblings(Carbon $dateFrom, Carbon $dateTo, int $tripId)
    {
        // todo: поверить, что даты с другими trip details не пересекаются, у которых родитель 1
    }

}