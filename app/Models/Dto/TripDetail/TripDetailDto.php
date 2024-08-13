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
        $status = $data['status'] ? $tripStatusService->getByValue($data['status']) : $tripStatusService->getDefault();

        return new self($data['tripId'], $data['title'], $data['slug'], $dateFrom, $dateTo, $data['description'], $status, $data['countryId'], $data['cityId']);
    }

    protected function defineFields(): array
    {
        return [
            'trip_id' => $this->tripId,
            'title' => $this->title,
            'slug' => $this->slug,
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo,
            'description' => $this->description,
            'status' => $this->status,
            'country_id' => $this->countryId,
            'city_id' => $this->cityId,
        ];
    }
}