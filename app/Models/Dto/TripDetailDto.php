<?php

namespace App\Models\Dto;

class TripDetailDto extends BaseDto
{
    private ?string $title;

    private ?string $slug;

    private ?string $dateFrom;

    private ?string $dateTo;

    private ?int $id = null;

    private ?int $cityId;

    private ?int $countryId;

    private ?int $status;

    public function __construct(array $request)
    {
        // $this->title = $request['title'] ?? null;
        // $this->slug = $request['slug'] ?? null;
        $this->dateFrom = $request['dateFrom'] ?? null;
        $this->dateTo = $request['dateTo'] ?? null;
        $this->id = $request['id'] ?? null;
        $this->status = $request['status'] ?? null;
        $this->cityId = $request['cityId'] ?? null;
        $this->countryId = $request['countryId'] ?? null;
    }

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

    public function toArray($withEmptyValues = false): array
    {
        $data = [
            'id' => $this->getId(),
            // 'title' => $this->getTitle(),
            // 'slug' => $this->getSlug(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'status' => $this->getStatus(),
        ];

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}