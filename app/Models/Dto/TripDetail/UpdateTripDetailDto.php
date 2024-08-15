<?php

namespace App\Models\Dto\TripDetail;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\TripStatusService;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

class UpdateTripDetailDto extends TripDetailDtoBase
{

    private function __construct(
        int $id,
        ?string $title,
        ?string $slug,
        ?Carbon $dateFrom,
        ?Carbon $dateTo,
        ?string $description,
        ?TripStatusEnum $status,
        ?int $countryId,
        ?int $cityId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->dateFrom = $dateFrom;
        $this->description = $description;
        $this->dateTo = $dateTo;
        $this->status = $status;
        $this->countryId = $countryId;
        $this->cityId = $cityId;
    }

    public static function create(int $id, array $data): UpdateTripDetailDto
    {
        if (isset($data['dateFrom'])) {
            $dateFrom = DateHelper::toCarbonDate($data['dateFrom']);
        }
        if (isset($data['dateTo'])) {
            $dateTo = DateHelper::toCarbonDate($data['dateTo']);
        }
        
        if (isset($data['status'])) {
            $tripStatusService = new TripStatusService();
            $status = $tripStatusService->getByValue($data['status']);
        }

        return new self(
            $id,
            $data['title'] ?? null,
            $data['slug'] ?? null,
            $dateFrom ?? null,
            $dateTo ?? null,
            $data['description'] ?? null,
            $status ?? null,
            $data['countryId'] ?? null,
            $data['cityId'] ?? null
        );
    }

    protected function defineFields(): array
    {
        return [
            'id' => $this->id,
            'date_from' => $this->getDateFrom(),
            'date_to' => $this->getDateTo(),
            'status' => $this->getStatus(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'country_id' => $this->getCountryId(),
            'city_id' => $this->getCityId(),
            'slug' => $this->getSlug(),
        ];
    }
}