<?php

namespace App\Models\Dto\TripDetail;

final class TripDetailDto extends TripDetailDtoBase
{
    public function __construct(array $request)
    {
        $this->tripId = $request['tripId'] ?? null;
        $this->title = $request['title'] ?? null;
        $this->slug = $request['slug'] ?? null;
        $this->dateFrom = $request['dateFrom'] ?? null;
        $this->dateTo = $request['dateTo'] ?? null;
        $this->description = $request['description'] ?? null;
        $this->status = $request['status'] ?? null;
        $this->cityId = $request['cityId'] ?? null;
        $this->countryId = $request['countryId'] ?? null;
    }

    protected function defineFields(): array
    {
        return [
            // 'id' => $this->getId(),
            'trip_id' => $this->getTripId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'country_id' => $this->getCountryId(),
            'city_id' => $this->getCityId(),
        ];
    }
}