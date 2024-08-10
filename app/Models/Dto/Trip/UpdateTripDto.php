<?php

namespace App\Models\Dto\Trip;

use App\Http\Services\Base\DateHelper;
use App\Http\Services\Enum\TripStatusService;

class UpdateTripDto extends TripDtoBase
{
    public function __construct(
        int $id,
        string $title = null,
        string $slug = null,
        int $status = null,
        string $dateFrom = null,
        string $dateTo= null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;

        if ($dateFrom)
            $this->dateFrom = DateHelper::toCarbonDate($dateFrom);
        if ($dateTo)
            $this->dateTo = DateHelper::toCarbonDate($dateTo);

        if ($status) {
            $tripStatusService = new TripStatusService();
            $this->status = $status ? $tripStatusService->getByValue($status) : $tripStatusService->getDefault();
        }
    }

    protected function defineFields(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'date_from' => $this->dateFrom ?? null,
            'date_to' => $this->dateTo ?? null,
            'status' => $this->status ?? null,
        ];
    }
}