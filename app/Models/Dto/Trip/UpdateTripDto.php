<?php

namespace App\Models\Dto\Trip;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\TripStatusService;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

class UpdateTripDto extends TripDtoBase
{
    private function __construct(
        int $id,
        ?string $title,
        ?string $slug,
        ?TripStatusEnum $status,
        ?Carbon $dateFrom,
        ?Carbon $dateTo)
    {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
    }

    public static function create(
        int $id,
        string $title = null,
        string $slug = null,
        int $status = null,
        string $dateFrom = null,
        string $dateTo = null): UpdateTripDto
    {
        // todo: Make a wrapper class or adapter or factory to exclude logic from the dto (for dates, statuses, ect)
        if ($dateFrom)
            $dateFrom = DateHelper::toCarbonDate($dateFrom);
        if ($dateTo)
            $dateTo = DateHelper::toCarbonDate($dateTo);
        if (!is_null($status)) {
            $tripStatusService = new TripStatusService();
            $status = $status ? $tripStatusService->getByValue($status) : $tripStatusService->getDefault();
        }

        return new self($id, $title, $slug, $status, $dateFrom, $dateTo);
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