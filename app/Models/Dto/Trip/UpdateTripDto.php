<?php

namespace App\Models\Dto\Trip;

use App\Helpers\DateHelper;
use App\Http\Services\Enum\TripStatusEnumService;
use App\Models\Enum\TripStatusEnum;
use Carbon\Carbon;

class UpdateTripDto extends TripDtoBase
{
    private function __construct(
        int $id,
        ?string $title,
        ?string $slug,
        ?TripStatusEnum $status,
        ?string $description,
        ?Carbon $dateFrom,
        ?Carbon $dateTo)
    {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->description = $description;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
    }

    public static function create(
        int $id,
        ?string $title = null,
        ?string $slug = null,
        ?int $status = null,
        ?string $description = null,
        ?string $dateFrom = null,
        ?string $dateTo = null): UpdateTripDto
    {
        if ($dateFrom)
            $dateFrom = DateHelper::toCarbonDate($dateFrom);
        if ($dateTo)
            $dateTo = DateHelper::toCarbonDate($dateTo);
        if (!is_null($status)) {
            $tripStatusEnumService = new TripStatusEnumService();
            $status = $status ? $tripStatusEnumService->getByValue($status) : $tripStatusEnumService->getDefault();
        }

        return new self($id, $title, $slug, $status, $description, $dateFrom, $dateTo);
    }

    protected function defineFields(): array
    {
        return [
            self::ID => $this->id,
            self::TITLE => $this->title,
            self::SLUG => $this->slug,
            self::DATE_FROM => $this->dateFrom ?? null,
            self::DATE_TO => $this->dateTo ?? null,
            self::STATUS => $this->status ?? null,
            self::DESCRIPTION => $this->description ?? null,
        ];
    }
}