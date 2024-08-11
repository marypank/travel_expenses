<?php

namespace App\Models\Dto\Trip;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\TripStatusService;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

class TripDto extends TripDtoBase
{
    private function __construct(
        int $userId,
        string $title,
        string $slug,
        Carbon $dateFrom,
        Carbon $dateTo,
        TripStatusEnum $status)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->slug = $slug;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
    }

    public static function create(
        int $userId,
        string $title,
        string $slug,
        string $dateFrom,
        string $dateTo,
        int $status = null): TripDto
    {
        $dateFrom = DateHelper::toCarbonDate($dateFrom);
        $dateTo = DateHelper::toCarbonDate($dateTo);
        
        // todo: DRY
        $tripStatusService = new TripStatusService();
        $status = $status ? $tripStatusService->getByValue($status) : $tripStatusService->getDefault();

        return new self($userId, $title, $slug, $dateFrom, $dateTo, $status);
    }

    protected function defineFields(): array
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