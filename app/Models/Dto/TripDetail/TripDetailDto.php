<?php

namespace App\Models\Dto\TripDetail;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\TripStatusService;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

final class TripDetailDto extends TripDetailDtoBase
{
    private function __construct(
        int $tripId,
        string $title,
        string $slug,
        Carbon $dateFrom,
        Carbon $dateTo,
        ?string $description,
        TripStatusEnum $status,
        int $countryId,
        int $cityId)
    {
        $this->tripId = $tripId;
        $this->title = $title;
        $this->slug = $slug;
        $this->dateFrom = $dateFrom;
        $this->description = $description;
        $this->dateTo = $dateTo;
        $this->status = $status;
        $this->countryId = $countryId;
        $this->cityId = $cityId;
    }

    public static function create(array $data): TripDetailDto
    {
        // todo: DRY
        $dateFrom = DateHelper::toCarbonDate($data['dateFrom']);
        $dateTo = DateHelper::toCarbonDate($data['dateTo']);
        
        $tripStatusService = new TripStatusService();
        $status = isset($data['status']) ? $tripStatusService->getByValue($data['status']) : $tripStatusService->getDefault();

        return new self($data['tripId'], $data['title'], $data['slug'], $dateFrom, $dateTo, $data['description'] ?? null, $status, $data['countryId'], $data['cityId']);
    }

    protected function defineFields(): array
    {
        return [
            self::TRIP_ID => $this->tripId,
            self::TITLE => $this->title,
            self::SLUG => $this->slug,
            self::DATE_FROM => $this->dateFrom,
            self::DATE_TO => $this->dateTo,
            self::DESCRIPTION => $this->description,
            self::STATUS => $this->status,
            self::COUNTRY_ID => $this->countryId,
            self::CITY_ID => $this->cityId,
        ];
    }
}