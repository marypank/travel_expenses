<?php

namespace App\Models\Dto\Trip;

use App\Models\Dto\Base\BaseDto;

class TripDto extends BaseDto
{
    private ?string $title;

    private ?string $slug;

    private ?string $dateFrom;

    private ?string $dateTo;

    private ?int $userId;

    private ?int $id = null;

    private ?int $status;

    public function __construct(array $request)
    {
        $this->title = $request['title'] ?? null;
        $this->slug = $request['slug'] ?? null;
        $this->dateFrom = $request['dateFrom'] ?? null;
        $this->dateTo = $request['dateTo'] ?? null;
        $this->userId = $request['userId'] ?? null;
        $this->id = $request['id'] ?? null;
        $this->status = $request['status'] ?? null;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
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
            'user_id' => $this->getUserId(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'status' => $this->getStatus(),
        ];

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}