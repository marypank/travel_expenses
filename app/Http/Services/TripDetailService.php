<?php

namespace App\Http\Services;

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
        $this->checkDatesOfParentTripOrThrowError($dto->getDateFrom(), $dto->getDateTo(), $dto->getTripId());

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

    private function checkDatesOfParentTripOrThrowError(?string $dateFrom = null, ?string $dateTo = null, int $tripId)
    {
        $trip = $this->mainRepository->getParentTrip($tripId);

        if (($dateFrom && Carbon::parse($dateFrom) < $trip->date_from) || ($dateTo && Carbon::parse($dateTo) > $trip->date_to)) {
            throw new \Exception("dates doesnt match"); // todo: custom
        }
    }

}