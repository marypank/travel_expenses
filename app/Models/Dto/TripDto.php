<?php

namespace App\Models\Dto;

class TripDto
{
    private int $userId;

    public function __construct(
        private string $title,
        private string $slug,
        private string $dateFrom,
        private string $dateTo
    )
    {
        //
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}