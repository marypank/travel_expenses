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
        int $currencyId,
        TripStatusEnum $status)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->slug = $slug;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
        $this->currencyId = $currencyId;
    }

    public static function create(
        int $userId,
        string $title,
        string $slug,
        string $dateFrom,
        string $dateTo,
        int $currencyId,
        int $status = null): TripDto
    {
        $dateFrom = DateHelper::toCarbonDate($dateFrom);
        $dateTo = DateHelper::toCarbonDate($dateTo);
        
        // todo: DRY
        $tripStatusService = new TripStatusService();
        $status = $status ? $tripStatusService->getByValue($status) : $tripStatusService->getDefault();

        return new self($userId, $title, $slug, $dateFrom, $dateTo, $currencyId, $status);
    }

    protected function defineFields(): array
    {
        return [
            self::USER_ID => $this->userId,
            self::TITLE => $this->title,
            self::SLUG => $this->slug,
            self::DATE_FROM => $this->dateFrom,
            self::DATE_TO => $this->dateTo,
            self::STATUS => $this->status,
            self::CURRENCY_ID => $this->currencyId,
        ];
    }
}