<?php

namespace App\Models\Dto;

class SearchTripDto extends BaseDto
{
    private int $userId;
    private ?int $status = null;
    private ?string $dateFrom = null;
    private ?string $dateTo = null;

    public function __construct(
        ?int $status = null,
        ?string $dateFrom = null,
        ?string $dateTo = null
    )
    {
        $this->status = $status;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
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

    public function toArray($withEmptyValues = false): array
    {
        $data = [
            'user_id' => $this->getUserId(),
            'status'=> $this->getStatus(),
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
        ];

        return $withEmptyValues ? $data : $this->removeEmptyValues($data);
    }
}