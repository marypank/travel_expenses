<?php

namespace App\Models\Dto\Trip;

use App\Http\Services\Enum\TripStatusService;

class TripDto extends TripDtoBase
{
    public function __construct(
        int $userId,
        string $title,
        string $slug,
        string $dateFrom,
        string $dateTo,
        int $status = null)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->slug = $slug;

        $this->dateFrom = $this->toCarbonDate($dateFrom);
        $this->dateTo = $this->toCarbonDate($dateTo);

        $tripStatusService = new TripStatusService();
        $this->status = $status ? $tripStatusService->getByValue($status) : $tripStatusService->getDefault();
    }

    public function defineFields(): array
    {
        return [
            'user_id' => $this->userId,
            'title' => $this->title,
            'slug' => $this->slug,
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo,
            'status' => $this->status,
        ];
    }
}