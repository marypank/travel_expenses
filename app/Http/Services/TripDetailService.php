<?php

namespace App\Http\Services;

use App\Models\Dto\SearchTripDetailDto;
use App\Models\Enum\TripStatusEnum;
use App\Repositories\TripDetailRepository;
use Illuminate\Database\Eloquent\Collection;

class TripDetailService extends BaseService
{
    public function __construct(TripDetailRepository $tripDetailRepository)
    {
        parent::__construct($tripDetailRepository);
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