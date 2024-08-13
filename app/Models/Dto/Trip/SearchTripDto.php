<?php

namespace App\Models\Dto\Trip;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\TripStatusService;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

class SearchTripDto extends TripDtoBase
{
    // unused
    private function __construct(
        int $userId,
        ?TripStatusEnum $status,
        ?Carbon $dateFrom,
        ?Carbon $dateTo
    )
    {
        $this->userId = $userId;
        $this->status = $status;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public static function create(
        int $userId,
        int $status = null,
        string $dateFrom = null,
        string $dateTo = null): SearchTripDto
    {
        if ($dateFrom)
            $dateFrom = DateHelper::toCarbonDate($dateFrom);
        if ($dateTo)
            $dateTo = DateHelper::toCarbonDate($dateTo);
        if (!is_null($status)) {
            $tripStatusService = new TripStatusService();
            $status = $status ? $tripStatusService->getByValue($status) : $tripStatusService->getDefault();
        }

        return new self($userId, $status, $dateFrom, $dateTo);
    }

    public function defineFields(): array
    {
        return [
            'user_id' => $this->userId,
            'status'=> $this->status,
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo,
        ];
    }
}