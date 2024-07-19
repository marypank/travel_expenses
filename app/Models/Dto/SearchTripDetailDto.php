<?php

namespace App\Models\Dto;

class SearchTripDetailDto extends BaseDto
{
    private int $tripId;

    private ?int $status = null;
    
    private ?string $title = null;
    
    private ?string $dateFrom = null;
    
    private ?string $dateTo = null;

    private ?int $countyId = null;

    private ?int $cityid = null;

    public function __construct(
        int $tripId = null,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $status = null,
        ?string $title = null,
        ?int $countryId = null,
        ?int $cityId = null
    )
    {
        $this->tripId = $tripId;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
        $this->title = $title;
        $this->countyId = $countryId;
        $this->cityid = $cityId;
    }

    public function setTripId(int $tripId): self
    {
        $this->tripId = $tripId;

        return $this;
    }

    public function getTripId(): int
    {
        return $this->tripId;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    public function setDateFrom(?string $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    public function setDateTo(?string $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countyId;
    }

    public function setCountryId(?int $countryId): self
    {
        $this->countyId = $countryId;

        return $this;
    }

    public function getCityId(): ?int
    {
        return $this->cityid;
    }

    public function setCityId(?int $cityId): self
    {
        $this->cityid = $cityId;

        return $this;
    }

    public function toArray($withEmptyValues = false): array
    {
        $data = [
            'trip_id' => $this->getTripId(),
            'status'=> $this->getStatus(),
            'title' => $this->getTitle(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'country_id' => $this->getCountryId(),
            'city_id' => $this->getCityId(),
        ];

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}