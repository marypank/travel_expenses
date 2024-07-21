<?php

namespace App\Models\Dto\TripDetail;

class SearchTripDetailDto extends TripDetailDtoBase
{
    public function __construct(
        int $tripId = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $status = null,
        ?int $countryId = null,
        ?int $cityId = null
    )
    {
        $this->tripId = $tripId;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
        $this->countryId = $countryId;
        $this->cityId = $cityId;
    }

    protected function defineFields(): array
    {
        return [
            'trip_id' => $this->getTripId(),
            'status'=> $this->getStatus(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'country_id' => $this->getCountryId(),
            'city_id' => $this->getCityId(),
        ];
    }
}