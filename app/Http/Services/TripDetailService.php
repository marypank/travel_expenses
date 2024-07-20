<?php

namespace App\Http\Services;

use App\Models\Dto\TripDetail\SearchTripDetailDto;
use App\Models\Enum\TripStatusEnum;
use App\Repositories\TripDetailRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Dto\Base\BaseDtoInterface;
use Carbon\Carbon;

class TripDetailService extends BaseService
{
    public function __construct(TripDetailRepository $tripDetailRepository)
    {
        parent::__construct($tripDetailRepository);
    }

    public function create(BaseDtoInterface $dto): void
    {
        $trip = $this->mainRepository->getParentTrip($dto->getTripId());
        if (Carbon::parse($dto->getDateFrom()) < $trip->date_from || Carbon::parse($dto->getDateTo()) > $trip->date_to) {
            throw new \Exception("dates doesnt match"); // todo: custom
        }

        try {
            $model = $this->mainRepository->create($dto->toArray());

            if (!$model) {
                throw new \Exception("not created");
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function search(SearchTripDetailDto $dto): Collection
    {
        if (!$dto->getTripId()) {
            throw new \Exception('tripId required'); // todo: custom
        }
        if (!in_array($dto->getStatus(), array_column(TripStatusEnum::cases(), 'value'))) {
            throw new \Exception('status not defined'); // todo: custom
        }

        $result = $this->mainRepository->search(
            $dto->getTripId(),
            $dto->getDateFrom(),
            $dto->getDateTo(),
            $dto->getStatus(),
            $dto->getCountryId(),
            $dto->getStatus()
        );

        return $result;
    }

}