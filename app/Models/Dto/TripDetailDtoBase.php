<?php

namespace App\Models\Dto;

abstract class TripDetailDtoBase extends BaseDto
{
    /* todo: protected static const REQUIRED_FIELDS = [
        'update' => [],
        'create' => []
    ]; */

    protected ?int $id = null;

    protected ?int $tripId;

    protected ?string $title;

    protected ?string $slug;

    protected ?string $dateFrom;

    protected ?string $dateTo;

    protected ?string $description;

    protected ?int $status;

    protected ?int $cityId;

    protected ?int $countryId;

    protected abstract function defineFields(): array;

    public function setCityId(int $cityId): self
    {
        $this->cityId = $cityId;

        return $this;
    }

    public function getCityId(): ?int
    {
        return $this->cityId;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    public function setDateFrom(string $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    public function setDateTo(string $dateTo): self
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTripId(): ?int
    {
        return $this->tripId;
    }

    public function setTripId(?int $tripId): self
    {
        $this->tripId = $tripId;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $descr): self
    {
        $this->description = $descr;

        return $this;
    }

    public function setCountryId(?string $countryId): self
    {
        $this->countryId = $countryId;

        return $this;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function toArray($withEmptyValues = false): array
    {
        $data = $this->defineFields();

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}