<?php

namespace App\Models\Dto;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\TripStatusService;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

class TripDto extends TripDtoBase
{
    private function __construct(
        string $title,
        string $slug,
        Carbon $dateFrom,
        Carbon $dateTo,
        ?string $description = null,
        TripStatusEnum $status) // todo: посмотреть какой статус будет request возвращать
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->description = $description;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
    }

    public static function create(
        string $title,
        string $slug,
        string $dateFrom,
        string $dateTo,
        ?string $description = null,
        ?int $status = null): TripDto
    {
        $dateFrom = DateHelper::toCarbonDate($dateFrom);
        $dateTo = DateHelper::toCarbonDate($dateTo);
        
        $tripStatusService = new TripStatusService();
        $status = $status ? $tripStatusService->getByValue($status) : $tripStatusService->getDefault();

        return new self($title, $slug, $dateFrom, $dateTo, $description, $status);
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
            self::DESCRIPTION => $this->description,
        ];
    }
}